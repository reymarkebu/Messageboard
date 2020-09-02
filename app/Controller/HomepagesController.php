<?php
class HomepagesController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow('index', 'welcome'); 
    }

    function index() {
        //
    }

    function welcome() {
        //

        if($this->request->is('post')) {
            $this->redirect(array('action' => 'index'));    
        }
        
    }
}