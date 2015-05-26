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
                $this->set('user', $user);
                $this->set('header', true);
            }
        }
        
        
        public function index() {
            /** js setup **/
            $this->set('gmaps', true);
            
            
            $this->set('title', 'Dashboard');
            
            $Parties    = new Party;
            $Devices    = new Device;
            $Groups     = new Group;
            
            
            $this->set('upcomingParties', $Parties->findNextParties());
        }
        
    }
    