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
                    
                    
                    // saving this for wordpress
                    $wp_date = $event_date;
                    
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
                            
                            
                            /** Prepare Custom Fields for WP XML-RPC - get all needed data **/
                            $Host = $Groups->findHost($group);
                            $custom_fields = array(
                                            array('key' => 'party_host',            'value' => $Host->hostname),       
                                            array('key' => 'party_hostavatarurl',   'value' => UPLOADS_URL . 'mid_' .$Host->path),
                                            array('key' => 'party_grouphash',       'value' => $group),
                                            array('key' => 'party_location',        'value' => $location),
                                            array('key' => 'party_time',            'value' => $start . ' - ' . $end),
                                            array('key' => 'party_date',            'value' => $wp_date)
                                            );
                            
                            
                            /** Start WP XML-RPC **/
                            $wpClient = new \HieuLe\WordpressXmlrpcClient\WordpressClient();
                            $wpClient->setCredentials(WP_XMLRPC_ENDPOINT, WP_XMLRPC_USER, WP_XMLRPC_PSWD);
                            
                            
                            $content = array(
                                            'post_type' => 'party',
                                            'custom_fields' => $custom_fields
                                            );
                            
                            $wpid = $wpClient->newPost($location, $free_text, $content);
                            
                            $this->Party->update(array('wordpress_post_id' => $wpid), $idParty);
                            
                            
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
                    $id = $_POST['id'];
                    $data = $_POST;
                    // remove the extra "files" field that Summernote generates -
                    unset($data['files']);
                    unset($data['file']);
                    unset($data['users']);
                    unset($data['id']);
                    
                    // Add SuperHero Restarter!
                    $_POST['users'][] = 29;
                    if(empty($data['volunteers'])) {
                        $data['volunteers'] = count($_POST['users']);
                    }
                    
                    // saving this for WP 
                    $wp_date = $data['event_date'];
                    
                    // formatting dates for the DB
                    $data['event_date'] = dbDateNoTime($data['event_date']);
                    
                    
                    $u = $this->Party->update($data, $id);
                    
                    if(!$u) {
                        $response['danger'] = 'Something went wrong. Please check the data and try again.';
                    }
                    else {
                        $response['success'] = 'Party updated!';
                        
                        
                        /** Prepare Custom Fields for WP XML-RPC - get all needed data **/
                        $Host = $Groups->findHost($data['group']);
            
                        
                        $custom_fields = array(
                                        array('key' => 'party_host',            'value' => $Host->hostname),       
                                        array('key' => 'party_hostavatarurl',   'value' => UPLOADS_URL . 'mid_' . $Host->path),
                                        array('key' => 'party_grouphash',       'value' => $data['group']),
                                        array('key' => 'party_location',        'value' => $data['location']),
                                        array('key' => 'party_time',            'value' => $data['start'] . ' - ' . $data['end']),
                                        array('key' => 'party_date',            'value' => $wp_date)
                                        );
                        
                        
                        /** Start WP XML-RPC **/
                        $wpClient = new \HieuLe\WordpressXmlrpcClient\WordpressClient();
                        $wpClient->setCredentials(WP_XMLRPC_ENDPOINT, WP_XMLRPC_USER, WP_XMLRPC_PSWD);
                        
                        $content = array(
                                        'post_type' => 'party',
                                        'post_title' => $data['location'],
                                        'post_content' => $data['free_text'],
                                        'custom_fields' => $custom_fields
                                        );
                        
                        
                        // Check for WP existence in DB
                        $theParty = $this->Party->findOne($id);
                        if(!empty($theParty->wordpress_post_id)){
                        
                            // we need to remap all custom fields because they all get unique IDs across all posts, so they don't get mixed up.
                            $thePost = $wpClient->getPost($theParty->wordpress_post_id);
                            
                            foreach( $thePost['custom_fields'] as $i => $field ){
                                foreach( $custom_fields as $k => $set_field){
                                    if($field['key'] == $set_field['key']){
                                        $custom_fields[$k]['id'] = $field['id'];
                                    }
                                }
                            }
                            
                            $content['custom_fields'] = $custom_fields;
                            $wpClient->editPost($theParty->wordpress_post_id, $content);
                        }
                        else {
                            
                            
                            
                            $wpid = $wpClient->newPost($Host->groupname, $free_text, $content);
                            $this->Party->update(array('wordpress_post_id' => $wpid), $idParty);
                        }
                        
                        
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
                
                $this->set('js', 
                            array('foot' => array(
                                            '/components/jquery.floatThead/dist/jquery.floatThead.min.js'
                            )));
                
                $Device     = new Device;
                $Category   = new Category;
                $User       = new User;
                
                if(isset($_POST) && !empty($_POST) && is_numeric($_POST['idparty']) && ($_POST['idparty'] > 0) ) {
                    $response = null;
                    
                    $partydata = $_POST['party'];
                    $idparty = $_POST['idparty'];
                    $this->Party->update($partydata, $idparty);
                    
                    if(isset($_POST['device'])){ 
                        $devices = $_POST['device'];
                        
                        
                        
                        foreach ($devices as $i => $device){
                            
                            //dbga($device);
                            $error = false;
                            $device['event'] = $id;
                            $method = null;    
                            
                            if(isset($device['id']) && is_numeric($device['id'])){
                                $method = 'update';
                                $iddevice = $device['id'];
                                unset($device['id']);
                            }
                            
                            if(!isset($device['category']) || empty($device['category'])){
                                $response['danger'] = 'Category needed! (device # ' . $i . ')';
                                $error = true;
                            }
                            
                            
                            if(!isset($device['repaired_by']) || empty($device['repaired_by'])){
                                $device['repaired_by'] = 29;
                            }
                            
                            if($error == false){
                                
                                
                                
                                if($method == 'update'){
                                    //echo "updating---";
                                    $Device->update($device, $iddevice);
                                }
                                
                                else {
                                    //echo "creating---";
                                    $device['category_creation'] = $device['category'];
                                    $Device->create($device);
                                }
                                
                                
                                /** WP Sync **/
                                $party = $this->Party->findThis($idparty, true);
                                
                                $Groups = new Group;
                                $partygroup = $party->group;
                                $Host = $Groups->findHost($party->group);
            
                                /** prepare party stats **/
                                
                                $wp_date = strftime('%d/%m/%Y', $party->event_date);
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
                                
                                
                                $stats = '
                                <div class="data">
                                    <div class="stat double">
                                        <div class="col">
                                            <i class="fa fa-group"></i>
                                            <span class="subtext">participants</span>
                                        </div>
                                        <div class="col">
                                            '. $party->pax .'"
                                        </div>
                                        
                                    </div>
                                    <div class="stat double">
                                        <div class="col">
                                            <span class="subtext">restarters</span>
                                        </div>
                                        <div class="col">
                                            '.$party->volunteers.'
                                        </div>
                                    </div>
                                    <div class="stat">
                                        <div class="footprint">
                                            '.$party->co2.'
                                            <span class="subtext">kg of CO<sub>2</sub></span>
                                        </div>
                                    </div>
                                    <div class="stat fixed">
                                        <div class="col"><i class="status mid fixed"></i></div>
                                        <div class="col">' . $party->fixed_devices .'</div>    
                                    </div>
                                    <div class="stat repairable">
                                        <div class="col"><i class="status mid repairable"></i></div>
                                        <div class="col">'. $party->repairable_devices .'</div>
                                    </div>
                                    <div class="stat dead">
                                        <div class="col"><i class="status mid dead"></i></div>
                                        <div class="col">'. $party->dead_devices .'</div>
                                    </div>
                                </div>';
                                
                                
                                $custom_fields = array(
                                                array('key' => 'party_host',            'value' => $Host->hostname),       
                                                array('key' => 'party_hostavatarurl',   'value' => UPLOADS_URL . 'mid_' . $Host->path),
                                                array('key' => 'party_grouphash',       'value' => $party->group),
                                                array('key' => 'party_location',        'value' => $party->location),
                                                array('key' => 'party_time',            'value' => substr($party->start, 0, -3) . ' - ' . substr($party->end, 0, -3)),
                                                array('key' => 'party_date',            'value' => $wp_date),
                                //                array('key' => 'party_timestamp',       'value' => $party->event_timestamp),
                                                array('key' => 'party_stats',           'value' => $stats)
                                                );                    
                                
                                
                                /** Start WP XML-RPC **/
                                $wpClient = new \HieuLe\WordpressXmlrpcClient\WordpressClient();
                                var_dump($wpClient); die();
                                
                                $wpClient->setCredentials(WP_XMLRPC_ENDPOINT, WP_XMLRPC_USER, WP_XMLRPC_PSWD);
                                
                                $content = array(
                                                'post_type' => 'party',
                                                'post_title' => $Host->groupname . ' - ' . $party->location,
                                                'post_content' => $party->free_text,
                                                'custom_fields' => $custom_fields
                                                );
                                
                                // Check for WP existence in DB
                                $theParty = $this->Party->findOne($id);
                                if(!empty($theParty->wordpress_post_id)){
                                
                                    // we need to remap all custom fields because they all get unique IDs across all posts, so they don't get mixed up.
                                    $thePost = $wpClient->getPost($theParty->wordpress_post_id);
                                    
                                    foreach( $thePost['custom_fields'] as $i => $field ){
                                        foreach( $custom_fields as $k => $set_field){
                                            if($field['key'] == $set_field['key']){
                                                $custom_fields[$k]['id'] = $field['id'];
                                            }
                                        }
                                    }
                                    
                                    $content['custom_fields'] = $custom_fields;
                                    $wpClient->editPost($theParty->wordpress_post_id, $content);
                                }
                                else {
                                    
                                    $wpid = $wpClient->newPost($Host->groupname, $party->free_text, $content);
                                    $this->Party->update(array('wordpress_post_id' => $wpid), $idparty);
                                }
                                
                                unset($party);
                                
                                /** Update Group Stats **/
/*                                
                                $allparties = $this->Party->ofThisGroup($partygroup, true, true);
            
                                $participants = 0;
                                $hours_volunteered = 0;
                                
                                $need_attention = 0;
                                foreach($allparties as $i => $party){
                                    if($party->device_count == 0){
                                        $need_attention++;    
                                    }
                                    
                                    $party->co2 = 0;
                                    $party->fixed_devices = 0;
                                    $party->repairable_devices = 0;
                                    $party->dead_devices = 0;
                                    
                                    $participants += $party->pax;
                                    $hours_volunteered += (($party->volunteers > 0 ? $party->volunteers * 3 : 12 ) + 9);
                                    
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
                                    
                                    $party->co2 = number_format(round($party->co2 * $Device->displacement), 0, '.' , ',');    
                                }
                                $weights = $Device->getWeights($partygroup);
                                $devices = $Device->ofThisGroup($partygroup);
                                $parties_thrown = count($allparties);
                                
                                $co2_years = $Device->countCO2ByYear($partygroup);
                                $co2sum = 0;
                                foreach($co2_years as $y){
                                    $co2sum += $y->co2;
                                }
                                
                                
                                $waste_years = $Device->countWasteByYear($partygroup);
                                $wastesum = 0;
                                foreach($waste_years as $y){
                                    $wastesum += $y->waste;
                                }
                                        
                                        
                                $groupstats =
                                '<div class="stat">
                                    <div class="col">
                                        <h5>participants</h5>
                                    </div>
                                    <div class="col">
                                        <span class="largetext">' .  $participants . '</span>
                                    </div>
                                </div>
                                <div class="stat">
                                    <div class="col">
                                        <h5>hours volunteered</h5>
                                    </div>
                                    <div class="col">
                                        <span class="largetext">' . $hours_volunteered . '</span>
                                    </div>
                                </div>
                                <div class="stat">    
                                    <div class="col">
                                        <h5>parties thrown</h5>
                                    </div>
                                    <div class="col">
                                        <span class="largetext">' . count($allparties) . '</span>
                                    </div>
                                </div>
                                <div class="stat">    
                                    <div class="col">
                                        <h5>waste prevented</h5>
                                    </div>
                                    <div class="col">
                                        <span class="largetext">' . number_format(round($wastesum), 0, '.', ',') . ' kg</span>
                                    </div>
                                </div>
                                <div class="stat">    
                                    <div class="col">
                                        <h5>CO<sub>2</sub> emission prevented</h5>
                                    </div>
                                    <div class="col">
                                        <span class="largetext">' . number_format(round($co2sum), 0, '.', ',') . ' kg</span>
                                    </div>
                                </div>';
                                
                                $custom_fields = array(
                                                    array('key' => 'group_stats', 'value' => $groupstats)   
                                                    );
                                
                                $theGroup = $Groups->findOne($partygroup);
                                $content = array(
                                        'post_type' => 'group',
                                        'post_title' => $Host->groupname,
                                        'post_content' => $theGroup->free_text,
                                        'custom_fields' => $custom_fields
                                        );
                        
                        
                                // Check for WP existence in DB
                                
                                if(!empty($theGroup->wordpress_post_id)){
                                    
                                    // we need to remap all custom fields because they all get unique IDs across all posts, so they don't get mixed up.
                                    $thePost = $wpClient->getPost($theGroup->wordpress_post_id);
                                    
                                    foreach( $thePost['custom_fields'] as $i => $field ){
                                        foreach( $custom_fields as $k => $set_field){
                                            if($field['key'] == $set_field['key']){
                                                $custom_fields[$k]['id'] = $field['id'];
                                            }
                                        }
                                    }
                                    
                                    $content['custom_fields'] = $custom_fields;
                                    $wpClient->editPost($theGroup->wordpress_post_id, $content);
                                
                                }
                                */
                                /** EOF WP Sync **/        
                                
                                $response['success'] = 'Party info updated!';
                                
                                header('Location: /host');
                            }
                            else {
                                //echo "No.";
                                $this->set('response', $response);
                            }
                        }
                    }
                
                        
                }
                
                $party      = $this->Party->findThis($id, true);
                $categories = $Category->listed();
                $restarters = $User->find(array('idroles' => 4));
                
                
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
                $this->set('restarters', $restarters);
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
    