<?php

    class AjaxController extends Controller {
        
        /** this class exposes JSON objects  **/
        
        
        public function restarters_in_group(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {
                
                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);
                $this->set('header', true);
            
                if(isset($_GET['group']) && is_numeric($_GET['group'])) {
                    $group = (integer)$_GET['group'];    
                    
                    $Users = new User;
                    $restarters = $Users->inGroup($group);
                    
                    echo json_encode($restarters);
                }
            }
        }
        
        public function group_locations() {
            $Groups = new Group;
            $groups = $Groups->findAll();
            
            echo json_encode($groups);
        }
        
    }