<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    var $name = 'User';
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Name is required'
            ),
            'between' => array(
                'rule' => array('between', 5, 20), 
                'message' => 'Names must be between 5 to 20 characters'
            ),
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Please provide a valid email address.'   
            ),
             'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A password is required'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Please confirm your password'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Passwords don\'t match.'
            )
        ),
        'new_password' => array(
            'min_length' => array(
                'rule' => array('minLength', 2),
                'message' => 'Password must have a mimimum of 2 characters',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'new_password_confirm' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield','new_password'),
                'message' => 'Both passwords must match.',
                'allowEmpty' => true,
                'required' => false,
            )
        ),
        'birthdate' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Please enter Date of Birth.'
            ),
        ),
        'hubby' => array(
            'required' => array(
                'rule' => array('minLength', 10),
                'allowEmpty' => false,
                'message' => 'Hubby should have at least 10 minimum characters.'
            ),
        ),
        'gender' => array(
            'required' => array(
                'rule' => array('notBlank'),
            )
        ),
        'status' => array(
            'required' => array(
                'rule' => array('notBlank'),
            )
        ),
    );

    public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
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

    public function beforeSave($options = array()) {      
                
        if(empty($this->data['User']['last_login_time']) && $this->data['User']['last_login_time'] === null) {
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new SimplePasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
        }

        
        if(!empty($this->data['User']['new_password']) && !empty($this->data['User']['new_password_confirm'])) {

            if (isset($this->data[$this->alias]['new_password'])) {
                $passwordHasher = new SimplePasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['new_password']
                );
            }
        }
            
        return true;
    }


}