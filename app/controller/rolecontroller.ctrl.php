<?php

    class RoleController extends Controller {
        
        public function __construct($model, $controller, $action){
            parent::__construct($model, $controller, $action);
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {
                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
            }
        }
        
        public function index() {
            $this->set('title', 'Roles');
            $this->set('roleList', $this->Role->findAll());
        }
        
    }
    