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
        
        public function party_data(){
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                $party = $_GET['id'];
            }
            else {
                echo json_encode(array('code'=>500, 'status'=>'danger', 'message' => 'Missing Parameter.'));
                return false;    
            }
            
            $Party = new Party;
            $party = $Party->findOne($party);
            echo json_encode($party);
            return true;
        }
        
        public function category_list(){
            $Category = new Category;
            $categories = $Category->listed();
            
            $response = '';
            
            foreach($categories as $cluster){ 
                $response .= '<optgroup label="' . $cluster->name . '">';
                foreach($cluster->categories as $c){ 
                    $response .= '<option value="' . $c->idcategories . '">' .  $c->name . '</option>';
                }
                $response .= '</optgroup>';
            } 
            
            echo $response;
        }
        
    }