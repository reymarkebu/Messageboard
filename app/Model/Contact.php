<?php

class Contact extends AppModel {
    
    public $validate = array(
        'user_id' => array(
            'required' => array(
                'rule' => array('notBlank'), 
            ),
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Please provide a valid email address.'   
            ),
             'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in your Contacts',
             ),
        ),
    );

    function isUniqueEmail($check) {
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'Contact.id'
                ),
                'conditions' => array(
                    'Contact.email' => $check['email'],
                    'Contact.user_id' => $this->data['Contact']['user_id']
                )
            )
        );

        if(!empty($email)){
            if(!empty($this->data[$this->alias]['id']) && $this->data[$this->alias]['id'] == $email['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
    }

    function findUserByEmail($email) {

        $userModel = ClassRegistry::init('User');
        $email = $userModel->find('first', array(
            'conditions' => array(
                'email' => $email
            )
        ));
        
        return $email;
    }

    function getAllContactUsers($user_id) {
        $options = array(
            'conditions' =>
                array('Contact.user_id = '. $user_id),
            'joins' =>
                array(
                    array(
                        'table'     =>  'users',
                        'alias'     =>  'User',
                        'type'      =>  'left',
                        'foreighnKey' => false,
                        'conditions' => array('User.email = Contact.email') 
                    ),
                ),
            'fields' => array('User.name, User.id, Contact.id, Contact.email')
        );

        $contacts = $this->find('all',$options);

        return $contacts;
    }

    public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {    
        $recursive = -1;
        // Mandatory to have
        $this->useTable = false;
        $sql = '';
    
        $sql .= "SELECT User.name, User.id, Contact.id, Contact.email FROM `messageboard`.`contacts` AS `Contact` left JOIN `messageboard`.`users` AS `User` ON (`User`.`email` = `Contact`.`email`) WHERE `Contact`.`user_id` = ".$extra['extra']['user_id'];
    
        // Adding LIMIT Clause
        $sql .= ' limit '. (($page - 1) * $limit) . ', ' . $limit;
    
        $results = $this->query($sql);
    
        return $results;
    }

    public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
        
        $sql = '';
    
        $sql .= "SELECT COUNT(id) as pages FROM contacts WHERE `user_id` = ".$extra['extra']['user_id'];
    
        $this->recursive = $recursive;
    
        $results = $this->query($sql);
        
        return $results[0][0]['pages'];
    }
}
