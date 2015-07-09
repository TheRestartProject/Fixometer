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
            
            $this->set('title', 'Host Dashboard');
            $this->set('charts', true);
            
            //Object Instances
            $Group = new Group;
            $User = new User;
            $Party = new Party;
            $Device = new Device;
            
            $group = $Group->ofThisUser($this->user->id);
            $group = $group[0];
            
            $allparties = $Party->ofThisUser($this->user->id, true, true);
            
            $need_attention = 0;
            foreach($allparties as $i => $party){
                if($party->device_count == 0){
                    $need_attention++;    
                }
                
                $party->co2 = 0;
                $party->fixed_devices = 0;
                $party->repairable_devices = 0;
                $party->dead_devices = 0;
                
                
                
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
                
                $party->co2 = $party->co2 * $Device->displacement;    
            }
            
            $devices = $Device->ofThisGroup($group->idgroups);
            
            foreach($devices as $i => $device){
                
            }
            
            $this->set('need_attention', $need_attention);
            
            $this->set('group', $group);
            $this->set('profile', $User->profilePage($this->user->id));
            
            $this->set('upcomingparties', $Party->findNextParties($group->idgroups));
            $this->set('allparties', $allparties);
            
            $this->set('devices', $Device->ofThisGroup($group->idgroups)); 
            $this->set('device_count_status', $Device->statusCount());
            $this->set('group_device_count_status', $Device->statusCount($group->idgroups));
            
            
            // more stats...
            $co2_years = $Device->countCO2ByYear(1);
            $this->set('year_data', $co2_years);
            
            $stats = array();
            foreach($co2_years as $year){
                $stats[$year->year] = $year->co2;
            }
            
            $this->set('bar_chart_stats', array_reverse($stats, true));
            
            $clusters = array();
            for($i = 1; $i <= 4; $i++) {
                //$cluster = $Device->countByCluster($i, $group->idgroups);
                $cluster = $Device->countByCluster($i, 1);
                
                $total = 0;
                foreach($cluster as $state){
                    $total += $state->counter;
                }
                
                $cluster['total'] = $total;
                $clusters[$i] = $cluster;
                
            }
            
            $this->set('clusters', $clusters);
        }
    
    
    }
