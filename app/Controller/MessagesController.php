<?php

class MessagesController extends AppController {

    public $components = array(
        'RequestHandler'
    );

    public $paginate = array(
        'Messasge' => array(
            'limit' => 10,
        )
    );

    public function index() {

        // Do not forgot to set this, not sure why
        $this->Message->recursive = 0;

        
        // Setting up paging parameters
        $this->paginate = array('Message'=>array(
            'limit'=> 10, 
            'extra' => array(
                'user_id' => $this->Auth->user('id')
                ), 
            )
        );

        
        $messages = $this->paginate('Message');
        
        // $messages = $this->Message->filterData($data, $this->Auth->user('id'));

        $this->set(compact('messages'));
    }

    public function reply() {

        if( $this->request->is('ajax') ) {
            $this->Message->create();

            $requestData = $this->request->data;
            $token = explode('-', $requestData['token']);

            //set data
            if($this->Auth->user('id') === $token[0]) { // check sender
                $this->request->data['Message']['receiver_id'] = $token[1];
                $contact_user_id = $token[1];


            } elseif ($this->Auth->user('id') === $token[1]) {
                $this->request->data['Message']['receiver_id'] = $token[0];
                $contact_user_id = $token[0];
            }
            
            $this->request->data['Message']['sender_id'] = $this->Auth->user('id');
            $this->request->data['Message']['message'] = $requestData['message'];
            $this->request->data['Message']['message_token'] = $requestData['token'];


            

            $contact = $this->Message->getContact($this->Auth->user('id'), $contact_user_id);
            
            if(count($contact) > 0) {
                $this->request->data['Message']['contact_id'] = $contact['Contact']['id'];
            } else {
                $contact_id = $this->Message->addContact($this->Auth->user('id'), $contact_user_id);
                $this->request->data['Message']['contact_id'] = $contact_id;
            }

            if ($this->Message->save($this->request->data)) {
                $this->autoRender = false;

                if( $this->request->is('ajax') ) {

                    $messages = $this->Message->find('all', array(
                        'conditions' => array(
                            'message_token' => $requestData['token'],
                        ),
                        'order' => array('created' => 'ASC')
                    ));
                    
                    $htmlMessage = $this->Message->htmlParser($messages, $this->Auth->user('id'));
                }
                
                return $htmlMessage;
            }
        }
    }

    public function create() {
        
        if($this->request->is('post')) {
            $this->Message->create();
           
            //explode ids and asign: contact_id and contact_user_id
            $contact_id = explode('-', $this->request->data['Message']['contact_id']);
            $this->request->data['Message']['contact_id'] = $contact_id[0];
            $this->request->data['Message']['receiver_id'] = $contact_id[1];
            $this->request->data['Message']['sender_id'] = $this->Auth->user('id');


            //construct message token
            $receiver_id = $this->request->data['Message']['receiver_id'];
            if($this->request->data['Message']['receiver_id'] > $this->Auth->user('id')) {
                $this->request->data['Message']['message_token'] = $this->Auth->user('id').'-'.$receiver_id;
            } else {
                $this->request->data['Message']['message_token'] = $receiver_id.'-'.$this->Auth->user('id');
            }


            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('Message has been Sent'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to deliver your message! Please try again.'));
            }
        }
    }

    public function search() {
        $this->autoRender = false;
        if( $this->request->is('ajax') ) {
            $term = $this->request->query['q'];
            
            $result = $this->Message->getAllContactUsers($this->Auth->user('id'), $term);
            
            // Format the result for select2
            $contacts = [];
            foreach($result as $key => $contact) {
                $contacts[$key]['id'] = $contact['Contact']['id'] .'-'. $contact['User']['id'];
                $contacts[$key]['text'] = $contact['User']['name'];
            }
            
            echo json_encode($contacts);
        }
    }

    public function fetch($token) {

        $this->autoRender = false;

        if( $this->request->is('ajax') ) {

            $messages = $this->Message->find('all', array(
                'conditions' => array(
                    'message_token' => $token,
                ),
                'order' => array('created' => 'ASC')
            ));
            
            $htmlMessage = $this->Message->htmlParser($messages, $this->Auth->user('id'));
        }

        return $htmlMessage;
    }

    public function delete($token) {

        if ($this->request->is('ajax')) {

            if($this->Message->deleteAll(array('Message.message_token' => $token), false)) {
                $msg   = 'Your Chat was successfully deleted';
                
            } else {
                $msg = 'There was a problem deleting your Chat, please try again';
            }
        }

        // output JSON on AJAX request
        if($this->RequestHandler->isAjax()) {
            $this->autoRender = $this->layout = false;
            echo json_encode(array(
                'msg'=> $msg
                )
            );

            exit;
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function deleteMessage($id) {
        if(!$id) {
            throw new NotFoundException(__('Invalid ID'));
        }

        if ($this->request->is('ajax')) {
            if($this->Message->delete($id)) {
                $msg   = 'Your Message was successfully deleted';
            } else {
                $msg = 'There was a problem deleting your Message, please try again';
            }
        }

        // output JSON on AJAX request
        if($this->RequestHandler->isAjax()) {
            $this->autoRender = $this->layout = false;
            echo json_encode(array(
                'msg'=> $msg
                )
            );

            exit;
        }

        return $this->redirect(array('action' => 'index'));
    }
}
