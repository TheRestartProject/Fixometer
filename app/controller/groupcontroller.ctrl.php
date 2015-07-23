<?php

    class GroupController extends Controller {
        
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
        
        public function index($response = null){
            
            $this->set('title', 'Groups');
            $this->set('list', $this->Group->findAll());
            
            if(!is_null($response)){
                $this->set('response', $response);
            }
            
        }
        
        public function create(){
            
            // Administrators can add Groups.
            if(hasRole($this->user, 'Administrator')){
                $this->set('title', 'New Group');
                $this->set('gmaps', true);
                $this->set('js', 
                            array('head' => array(
                                            '/ext/geocoder.js'
                            )));
                    
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                    $error = array();
                    
                    // We got data! Elaborate.
                    $name       =       $_POST['name'];
                    $area       =       $_POST['area'];
                    $freq       =       $_POST['frequency'];
                    $location   =       $_POST['location'];
                    $latitude   =       $_POST['latitude'];
                    $longitude  =       $_POST['longitude'];
                    $text       =       $_POST['free_text'];
                    
                   
                    
                    
                    if(empty($name)){
                        $error['name'] = 'Please input a name.';
                    }
                    if(!empty($latitude) || !empty($longitude)) {
                        // check that these values are floats.
                        $check_lat = filter_var($latitude, FILTER_VALIDATE_FLOAT);
                        $check_lon = filter_var($longitude, FILTER_VALIDATE_FLOAT);
                        
                        if(!$check_lat || !$check_lon){
                            $error['location'] = 'Coordinates must be in the correct format.';
                        }
                        
                    }
                    
                    
                    if(empty($error)) {
                        // No errors. We can proceed and create the User.
                        $data = array(  'name'          => $name,
                                        'area'          => $area,
                                        'frequency'     => $freq,
                                        'location'      => $location,
                                        'latitude'      => $latitude,
                                        'longitude'     => $longitude,
                                        'free_text'     => $text,
                                        );
                        $idGroup = $this->Group->create($data);
                        if($idGroup){
                            $response['success'] = 'Group created correctly.';
                            
                            if(isset($_FILES) && !empty($_FILES)){
                                $file = new File;
                                $file->upload('image', 'image', $idGroup, TBL_GROUPS, false, true);    
                            }
                        }
                        else {
                            $response['danger'] = 'Group could <strong>not</strong> be created. Something went wrong with the database.';
                        }
                        
                    }
                    else {
                        $response['danger'] = 'Group could <strong>not</strong> be created. Please look at the reported errors, correct them, and try again.';
                    }
                    
                    
                    $this->set('response', $response);
                    $this->set('error', $error);
                    $this->set('udata', $_POST);
                    
                }
                
            }
            else {
                header('Location: /user/forbidden', true, 403);
            }
        }
        
        
    
        public function edit($id) {
            
            if(hasRole($this->user, 'Administrator') || hasRole($this->user, 'Host')){ 
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                    
                    $data = $_POST;
                    // remove the extra "files" field that Summernote generates -
                    unset($data['files']);
                    unset($data['image']);
                    $u = $this->Group->update($data, $id);
                    
                    if(!$u) {
                        $response['danger'] = 'Something went wrong. Please check the data and try again.';
                    }
                    else {
                        $response['success'] = 'Group updated!';
                        
                        if(isset($_FILES) && !empty($_FILES)){
                            $existing_image = $this->Group->hasImage($id, true);
                            if(count($existing_image) > 0){
                                $this->Group->removeImage($id, $existing_image[0]);
                            }
                            $file = new File;
                            $file->upload('image', 'image', $id, TBL_GROUPS, false, true);
                        }
                        if(hasRole($this->user, 'Host')){
                            header('Location: /host?action=gu&code=200');
                        }
                    }
                    
                    $this->set('response', $response);
                }
            }
            $this->set('gmaps', true);
            $this->set('js', array( 'head' => array( '/ext/geocoder.js')));
            
            $Group = $this->Group->findOne($id);
            $this->set('title', 'Edit Group ' . $Group->name );
            $this->set('formdata', $Group);
            
            
        }
        
        public function delete($id){
            if(hasRole($this->user, 'Administrator')){
                $r = $this->Group->delete($id);
                if(!$r){
                    $response = 'd:err';
                }
                else {
                    $response = 'd:ok';
                }
                header('Location: /group/index/' . $response);
            }
            else {
                header('Location: /user/forbidden');
            }
        }
    }
    