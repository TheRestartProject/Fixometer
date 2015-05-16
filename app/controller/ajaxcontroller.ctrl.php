<?php

    class AjaxController extends Controller {
        
        /** this class exposes JSON objects after verifying Auth **/
        
        public function __construct($model, $controller, $action){
            parent::__construct($model, $controller, $action);
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {
                
                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);
                $this->set('header', true);
            }
        }
        
        public function restarters_in_group(){
            if(isset($_GET['group']) && is_numeric($_GET['group'])) {
                $group = (integer)$_GET['group'];    
                
                $Users = new User;
                $restarters = $Users->inGroup($group);
                
                echo json_encode($restarters);
            }
        }
        
    }