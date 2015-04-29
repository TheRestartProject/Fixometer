<?php

    class DashboardController extends Controller {
        
        public function __construct($model, $controller, $action){
            parent::__construct($model, $controller, $action);
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {
                
                $user = $Auth->getProfile();
                
            }
        }
        
        
        public function index() {
            
            $this->set('title', 'Dashboard');
            
            //print_r($_SESSION);
            
        }
        
    }
    