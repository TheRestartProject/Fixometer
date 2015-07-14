<?php
    
    class PartyController extends Controller {
        
        protected $hostParties = array();
        
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
                
                if(hasRole($this->user, 'Host')){
                    $Group = new Group;
                    $group = $Group->ofThisUser($this->user->id);
                    $this->set('usergroup', $group[0]);
                    $parties = $this->Party->ofThisGroup($group[0]->idgroups);
                    
                    foreach($parties as $party){
                        $this->hostParties[] = $party->idevents;
                    }
                }
            }
        }
        
        public function index(){
            $this->set('title', 'Parties');
            $this->set('list', $this->Party->findAll()); 
        }
        
        public function create(){
            
            if( !hasRole($this->user, 'Host') && !hasRole($this->user, 'Administrator')){
                header('Location: /user/forbidden');
            }
            else {
                
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
                    
                    // Add SuperHero Restarter!
                    $_POST['users'][] = 29;
                    if(empty($_POST['volunteers'])) {
                        $volunteers = count($_POST['users']);
                    }
                    else {
                        $volunteers = $_POST['volunteers'];                        
                    }
                    
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
                    $event_date = date('Y-m-d', strtotime(engDate($event_date)));
                    
                    if(!verify($event_date)){
                        $error['event_date'] = 'We must have a starting date and time.';
                    }
                    if(!verify($start)){
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
                        
                        $startTime = date('Y-m-d', $event_date) . ' ' . $start;
                        $endTime = date('Y-m-d', $event_date) . ' ' . $end;
                        
                        $dtStart = new DateTime($startTime);
                        $dtDiff = $dtStart->diff(new DateTime($endTime));
                        
                        $hours = $dtDiff->h;
                        
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
                                        'group'         => $group,
                                        'hours'         => $hours,
                                        'volunteers'    => $volunteers
                                        );
                        $idParty = $this->Party->create($data);
                        
                        if($idParty){
                            $response['success'] = 'Party created correctly.';
                            /** check and create User List **/
                            $_POST['users'][] = 29;
                            if(isset($_POST['users']) && !empty($_POST['users'])){
                                $users = $_POST['users'];
                                $this->Party->createUserList($idParty, $users);
                            }
                            
                            
                            /** let's create the image attachment! **/
                            if(isset($_FILES) && !empty($_FILES)){
                                $file = new File;
                                $file->upload('file', 'image', $idParty, TBL_EVENTS);    
                            }
                            
                            if(hasRole($this->user, 'Host')){
                                header('Location: /host?action=pc&code=200');
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
        }
    
        public function edit($id){
            
            if( hasRole($this->user, 'Administrator') || (hasRole($this->user, 'Host') && in_array($id, $this->hostParties))){
                
                $Groups = new Group;
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                    
                    $data = $_POST;
                    // remove the extra "files" field that Summernote generates -
                    unset($data['files']);
                    unset($data['file']);
                    unset($data['users']);
                    
                    // Add SuperHero Restarter!
                    $_POST['users'][] = 29;
                    if(empty($data['volunteers'])) {
                        $data['volunteers'] = count($_POST['users']);
                    }
                    
                    // formatting dates for the DB
                    $data['event_date'] = dbDateNoTime($data['event_date']);
                    
                    
                    $u = $this->Party->update($data, $id);
                    
                    if(!$u) {
                        $response['danger'] = 'Something went wrong. Please check the data and try again.';
                    }
                    else {
                        $response['success'] = 'Party updated!';
                        
                        
                        if(isset($_POST['users']) && !empty($_POST['users'])){
                            $users = $_POST['users'];
                            $this->Party->createUserList($id, $users);
                        }
                            
                            
                        /** let's create the image attachment! **/
                        if(isset($_FILES) && !empty($_FILES)){
                            $file = new File;
                            $file->upload('file', 'image', $id, TBL_EVENTS);    
                        }
                            
                    }
                    if(hasRole($this->user, 'Host')){
                        header('Location: /host?action=pe&code=200');
                    }
                    $this->set('response', $response);
                }
            
                $this->set('gmaps', true);
                $this->set('js', array( 'head' => array( '/ext/geocoder.js')));
                
                $Party = $this->Party->findOne($id);
                $this->set('title', 'Edit Party');
                $this->set('group_list', $Groups->findAll());
                $this->set('formdata', $Party);
            
            }
            else {
                header('Location: /user/forbidden');
            }
        }
    
    
        public function manage($id){
            if( !hasRole($this->user, 'Host') && !hasRole($this->user, 'Administrator')){
                header('Location: /user/forbidden');
            }
            else {
                
                $Device     = new Device;
                $Category   = new Category;
                
                
                if(isset($_POST) && !empty($_POST) && is_numeric($_POST['idparty']) && ($_POST['idparty'] > 0) ) {
                    $partydata = $_POST['party'];
                    $idparty = $_POST['idparty'];
                    $this->Party->update($partydata, $idparty);
                
                
                        
                }
                
                $party      = $this->Party->findThis($id, true);
                $categories = $Category->listed();
                
                $party->co2 = 0;
                $party->fixed_devices = 0;
                $party->repairable_devices = 0;
                $party->dead_devices = 0;
                
                
                if(!empty($party->devices)){ 
                    foreach($party->devices as $device){
                        
                        $party->co2 += $device->footprint;
                        
                        switch($device->repair_status){
                            case 1:
                                $party->fixed_devices++;
                                break;
                            case 2:
                                $party->repairable_devices++;
                                break;
                            case 3:
                                $party->dead_devices++;
                                break;
                        }
                    }
                }
                
                $party->co2 = number_format(round($party->co2 * $Device->displacement), 0, '.' , ',');    
                
                $this->set('party', $party);
                $this->set('devices', $party->devices);
                $this->set('categories', $categories);
                
            }
        }
        
        
        public function delete($id){
            if(hasRole($this->user, 'Administrator') || (hasRole($this->user, 'Host') && in_array($id, $this->hostParties))){
                $r = $this->Party->delete($id);
                if(!$r){
                    $response = 'd:err';
                }
                else {
                    $response = 'd:ok';
                }
                
                if(hasRole($this->user, 'Host')){
                    header('Location: /host/index/' . $response);
                }
                else {
                    header('Location: /party/index/' . $response);    
                }
                
            }
            else {
                header('Location: /user/forbidden');
            }
        }
    }
    