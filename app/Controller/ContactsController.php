<?php


class ContactsController extends AppController {

    public $paginate = array(
        'Contact' => array(
            'limit' => 10,
        )
    );
    
    public function index() {

        // Do not forget to set this, not sure why
        $this->Contact->recursive = 0;

        // Setting up paging parameters
        $this->paginate = array('Contact'=>array(
            'limit'=> 10, 
            'extra' => array(
                'user_id' => $this->Auth->user('id')
                ), 
            )
        );

        $contacts = $this->paginate('Contact');
        $this->set('contacts', $contacts);

    }

    public function add() {
        
        if ($this->request->is('post')) {

            if ($this->request->data['Contact']['email'] === $this->Auth->user('email')) {
                $this->Session->setFlash(__('You cannot add yourself as your contact!'));
                
                return;
            }


            $this->request->data['Contact']['user_id'] = $this->Auth->user('id');

            //check if user exist
            $email = $this->Contact->findUserByEmail($this->request->data['Contact']['email']);
            
            if(count($email) > 0) {
                $this->Contact->create();

                if ($this->Contact->save($this->request->data)) {
                    $this->Session->setFlash(__('New contact has been saved.'));
                    
                    return $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('User does not exist!'));
            }
        }
    }

    public function viewProfile($id) {
        if(!$id) {
            throw new NotFoundException(__('Invalid Contact'));
        }

        $contact = $this->Contact->findById($id);
        
        if(count($contact) > 0) {
            $user = $this->Contact->findUserByEmail($contact['Contact']['email']);
            
            if(count($user) > 0) {
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $user['User']['id']));
            }
        }
    }

    public function delete($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Contact'));
        }

        if ($this->request->is('get')) {
            throw new NotFoundException();
        }  
    
        if ($this->Contact->delete($id)) {
            $this->Session->setFlash(__('Contact has been successfully deleted.'));
            return $this->redirect(array('action'=> 'index'));
        }

        $this->Session->setFlash(__('Unable to delete contact.'));
        return $this->redirect(array('action'=> 'index'));
    }
}
