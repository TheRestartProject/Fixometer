<?php

    class HostController extends Controller {
        
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
                
                if(!hasRole($this->user, 'Host')) {
                    header('Location: /user/forbidden');
                }
            }
        }
        
        public function index(){
            
            $this->set('title', 'The Fixometer');
            
            //Object Instances
            $Group = new Group;
            $User = new User;
            $Party = new Party;
            $Device = new Device;
            
            $group = $Group->ofThisUser($this->user->id);
            $group = $group[0];
            
            $allparties = $Party->ofThisUser($this->user->id, true, true);
            
            $need_attention = 0;
            foreach($allparties as $party){
                if($party->device_count == 0){
                    $need_attention++;    
                }
                
                $party->co2 = 0;
                foreach($party->devices as $device){
                    $party->co2 += $device->footprint;    
                }
                
                $party->co2 = $party->co2 * $Device->displacement;    
            }
            $this->set('need_attention', $need_attention);
            
            $this->set('group', $group);
            $this->set('profile', $User->profilePage($this->user->id));
            
            $this->set('upcomingparties', $Party->findNextParties($group->idgroups));
            $this->set('allparties', $allparties);
            
            
        }
    
    
    }
