<?php

    class DeviceController extends Controller {
        
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
        
        public function index(){
            
            $this->set('title', 'Devices');
            
            $this->set('list', $this->Device->getList()); 
            
        }
        
        public function create(){
            if(hasRole($user, 'Guest')){
                header('Location: /user/forbidden'); 
                
            }
            else {
                $Events = New Party;
                $Categories = New Category;
                
                $UserEvents = $Events->ofThisUser($this->user->id);    
                
                
                $this->set('categories', $Categories->findAll());
                $this->set('events', $UserEvents);
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                    $error = array();
                    $data = array_filter($_POST);
                    
                    if(!verify($data['event'])){ $error['event'] = 'Please select a Restart party.'; }
                    if(!verify($data['category'])){ $error['category'] = 'Please select a category for this device'; }
                    if(!verify($data['repair_status'])){ $error['repair_status'] = 'Please select a repair status.'; }
                    
                    if(!empty($error)){ 
                        $this->set('error', $error);
                        $response['danger'] = 'The device repair has <strong>not</strong> been saved.';
                    }
                    else {
                        // add user id
                        $data['repaired_by'] = $this->user->id;
                        // add initial category (for backlogging upon revision)
                        $data['category_creation'] = $data['category'];
                        
                        // save this!
                        $insert = $this->Device->create($data);
                        if(!$insert){
                            $response['danger'] = 'Error while saving the device tot he DB.';
                        }
                        else {
                            $response['success'] = 'Device saved!';
                        }
                        
                    }
                    
                    $this->set('response', $response);
                    $this->set('udata', $data);
                }
                
                $this->set('title', 'New Device');
            }
            
            
        }
    }
    