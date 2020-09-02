<?php
App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController {

    public $paginate = array(
        'limit' => 5,
        'conditions' => array('status' => '1'),
        'order' => array('User.created' => 'asc' ) 
    );

    public function beforeFilter() {
        $this->Auth->allow('add','welcome'); 
    }

    public function login() {
         
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
         
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            
            // $pass = $this->User->checkPasswordHash($this->request->data['User']['password']);
          
                
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('name')));
                
                // $this->Auth->user('last_login_time ')
                // $user = $this->Users->findById($this->Auth->user('name'));

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Invalid name or password'));
            }
        } 
    }

    public function logout() {
        return $this->redirect($this->Auth->logout($this->Auth->redirect(array('action' => 'login'))));
    }

    public function index() {
        $this->paginate = array(
            'limit' => 5,
            'order' => array('User.created' => 'asc')
        );

        $users = $this->paginate('User');
        $this->set(compact('users'));
    }



    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved.'));
                
                return $this->redirect(array('controller' => 'homepages', 'action' => 'welcome'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
        }
    }
}