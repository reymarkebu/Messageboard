<?php
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
         
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'view', $this->Auth->user('id')));      
        }

        if ($this->request->is('post')) {
                
            if ($this->Auth->login()) {
                
                // update last_login_time
                $this->User->read(null, $this->Auth->user('id'));
                $this->User->set(array(
                    'last_login_time' => date('Y-m-d H:i:s'),
                ));

                $this->User->save();

                $this->redirect(array('action' => 'view', $this->Auth->user('id') ));
            } else {
                $this->Session->setFlash(__('Invalid name or password'));
            }
        } 
    }

    public function logout() {
        return $this->redirect(
            $this->Auth->logout(
                $this->Auth->redirect(
                    array('action' => 'login')
                )
            )
        );
    }

    public function index() {
        $this->paginate = array(
            'limit' => 5,
            'order' => array('User.created' => 'desc')
        );

        $users = $this->paginate('User');
        print_r($this->params['paging']['User']);
        $this->set(compact('users'));
    }

    public function view($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }
        
        if ($user['User']['gender'] == 1) {
            $user['User']['gender'] = 'Male';
        } elseif ($user['User']['gender'] == 2) {
            $user['User']['gender'] = 'Female';
        } else {
            $user['User']['gender'] = '';
        }

        if ($user['User']['status'] == 1) {
            $user['User']['status'] = 'Online';
        } elseif ($user['User']['status'] == 2) {
            $user['User']['status'] = 'Away';
        } else {
            $user['User']['status'] = 'Do Not Disturb';
        }

        $this->set('user', $user);
    }

    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }

        if ($this->request->is(array('post', 'put'))) {
           
            //Check if image was sent
            if (!empty($this->request->data['User']['image'])) {

                if ($this->request->data['User']['image']['error'] === 0) {
                    $file = $this->request->data['User']['image']; // Creating a variable to handle upload
                    

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png');

                    //if extension is valid
                    if(in_array($ext, $arr_ext)) {

                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/users/' . $file['name']);
                    
                        $this->request->data['User']['image'] = $file['name'];
                    } else {
                        $this->Session->setFlash(__('Image extention is not valid!'));
                        $this->request->data = $user;
                        return;
                    }
                }
                else {
                    unset($this->request->data['User']['image']);
                }
            }
            
            
            // prepare for saving
            $this->User->id = $id;
            $this->request->data['User']['id'] = $id;
            $this->request->data['User']['last_login_time'] = $user['User']['last_login_time'];

            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your profile has been updated'));
                
                return $this->redirect(array('action' => 'view', $id));
            }

            $this->Session->setFlash(__('Unable to update your profile.'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();

            
			if ($this->User->save($this->request->data)) {				
                
                return $this->redirect(array('controller' => 'homepages', 'action' => 'welcome'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
        }
    }
}