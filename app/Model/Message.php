<?php
class Message extends AppModel {
    var $name = 'Message';
    
    public $validate = array(
        'message' => array(
            'required' => array(
                'rule' => array('notBlank'),    
                'message' => 'Message should not be blank'   
            ),
        ),
        'message_token' => array(
            'required' => array(
                'rule' => array('notBlank')
            ),
        ),
        'contact_id' => array(
            'required' => array(
                'rule' => array('notBlank'),    
                'message' => 'Message should not be blank'   
            ),
        ),
    );

    public function getAllContactUsers($user_id) {

        $contactModel = ClassRegistry::init('Contact');
        $data = $contactModel->getAllContactUsers($user_id);
        
        return $data;
    }

    function htmlParser($data, $user_id) {

        if (!$data) {
            return;
        }

        $htmlMessage = '';
        foreach($data as $val) {


            $id = $val['Message']['id'];
            if($val['Message']['sender_id'] === $user_id) {

            
                $htmlMessage .= '<div title="Click to Delete this message" class="outgoing_msg" id="delete_msg-'.$id.'" onclick="deleteMessage('.$id.')">';
                $htmlMessage .= '<div class="sent_msg" id='.$val['Message']['id'].'>';
                $htmlMessage .= '<p id='.$val['Message']['id'].'>'.$val['Message']['message'].'</p>';
                $htmlMessage .= '<span class="time_date">'.$val['Message']['created'].'</span> </div>';
                $htmlMessage .= '</div>';


            } else {

                $htmlMessage .= '<div class="incoming_msg">';
                $htmlMessage .= '<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>';
                $htmlMessage .= '<div class="received_msg">';
                $htmlMessage .= '<div class="received_withd_msg">';
                $htmlMessage .= '<p>'.$val['Message']['message'].'</p>';
                $htmlMessage .= '<span class="time_date">'.$val['Message']['created'].'</span></div>';
                $htmlMessage .= '</div>';
                $htmlMessage .= '</div>';

            }
        }

        return $htmlMessage;
    }

    public function getMessageList($user_id, $limit) {
        
        $db = $this->getDataSource();


        $data = $db->fetchAll(
            ' SELECT message.message, message.message_token, contact.id, message.created FROM (
                SELECT message_token, MAX(created) AS created 
                FROM messages 
                GROUP BY message_token
             ) AS x 
             JOIN messages `message` USING (message_token, created) 
             left join contacts as contact
                ON message.contact_id=contact.id 
            where (message.sender_id = :user_id OR message.receiver_id= :user_id) 
            order by message.created 
            desc '. $limit,
            array('user_id' => $user_id)
        );

        return $data;
    }

    public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {

        $recursive = -1;

        // Mandatory to have
        $this->useTable = false;
        $sql = '';

        // Adding LIMIT Clause
        $limit = ' limit '. (($page - 1) * $limit) . ', ' . $limit;
        $results = $this->getMessageList($extra['extra']['user_id'], $limit);
    
        return $results;
    }

    public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {

        $sql = '';
        $sql .= "SELECT COUNT(message.message_token) as pages FROM (
            SELECT message_token, MAX(created) AS created 
            FROM messages 
            GROUP BY message_token
         ) AS x 
         JOIN messages `message` USING (message_token, created) 
         left join contacts as contact
            ON message.contact_id=contact.id 
        where (message.sender_id = 1 OR message.receiver_id= 1) ";
    

        $this->recursive = $recursive;
        $results = $this->query($sql);
        
        return $results[0][0]['pages'];
    }

    public function filterData($data, $user_id) {
        foreach($data as $key => $val) {
            $token = $val['message']['message_token'];
            if($token) {
                
                $user_ids = explode('-', $token);
                if($user_ids[0] === $user_id) {
                    $receiver_id = $user_ids[1];
                } else {
                    $receiver_id = $user_ids[0];
                }

                $user = $this->getUser($receiver_id);

                if($user) {
                    $data[$key]['user']['name'] = $user['User']['name'];
                }
            }
        }

        return $data;
    }

    public function getUser($id) {
        $userModel = ClassRegistry::init('User');
        $user = $userModel->find('first', array(
            'conditions' => array(
                'id' => $id
            )
        ));

        return $user;
        
    }
}
