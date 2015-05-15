<?php
    
    class PartyController extends Controller {
        
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
            $this->set('title', 'Parties');
            $this->set('list', $this->Party->findAll()); 
        }
        
        public function create(){
            
            if(hasRole($this->user, 'Host') || hasRole($this->user, 'Administrator') ){
                
                $Groups = new Group;
                
                
                $this->set('title', 'New Party');
                $this->set('gmaps', true);
                $this->set('js', 
                            array('head' => array(
                                            '/ext/geocoder.js'
                            )));
                
                $this->set('group_list', $Groups->findAll());
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                    $error = array();
                    
                    // We got data! Elaborate.
                    $event_date =       $_POST['event_date'];
                    $start      =       $_POST['start'];
                    $end        =       $_POST['end'];
                    $pax        =       $_POST['pax'];
                    $free_text  =       $_POST['free_text'];
                    $location   =       $_POST['location'];
                    $latitude   =       $_POST['latitude'];
                    $longitude  =       $_POST['longitude'];
                    $group      =       $_POST['group'];
                    
                    // formatting dates for the DB
                    $event_date = date('Y-m-d', strtotime($event_date));
                    /*
                    $start = dbDate($start);
                    $end = dbDate($end);
                    */                   
                    
                    if(empty($event_date)){
                        $error['event_date'] = 'We must have a starting date and time.';
                    }
                    if(empty($start)){
                        $error['name'] = 'We must have a starting date and time.';
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
                        // No errors. We can proceed and create the Party.
                        $data = array(
                                        'event_date'    => $event_date,
                                        'start'         => $start,
                                        'end'           => $end,
                                        'pax'           => $pax,
                                        'free_text'     => $free_text,
                                        'location'      => $location,
                                        'latitude'      => $latitude,
                                        'longitude'     => $longitude,
                                        'group'         => $group
                                        );
                        $idParty = $this->Party->create($data);
                        
                        if($idParty){
                            $response['success'] = 'Party created correctly.';
                            
                            /** let's create the image attachment! **/
                            if(isset($_FILES) && !empty($_FILES)){
                                $file = new File;
                                $file->upload('file', 'image', $idParty, TBL_EVENTS);    
                            }
                            
                        }
                        else {
                            $response['danger'] = 'Party could <strong>not</strong> be created. Something went wrong with the database.';
                        }
                        
                    }
                    else {
                        $response['danger'] = 'Party could <strong>not</strong> be created. Please look at the reported errors, correct them, and try again.';
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
    }
    