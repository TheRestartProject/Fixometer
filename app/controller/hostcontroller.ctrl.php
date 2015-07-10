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
            
            $allparties = $Party->ofThisGroup($group->idgroups, true, true);
            
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
                
                $party->co2 = number_format(round($party->co2 * $Device->displacement), 0, '.' , ',');    
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
            
            /** co2 counters **/
            $co2_years = $Device->countCO2ByYear(1);
            $this->set('year_data', $co2_years);
            $stats = array();
            foreach($co2_years as $year){
                $stats[$year->year] = $year->co2;
            }
            $this->set('bar_chart_stats', array_reverse($stats, true));
            $co2Total = $Device->getWeights();
            $co2ThisYear = $Device->countCO2ByYear(null, date('Y', time()));
            
            $this->set('co2Total', $co2Total[0]->total_footprints);
            $this->set('co2ThisYear', $co2ThisYear[0]->co2);
            
            $clusters = array();
            
            for($i = 1; $i <= 4; $i++) {
                $cluster = $Device->countByCluster($i, $group->idgroups);
                $total = 0;
                foreach($cluster as $state){
                    $total += $state->counter;
                }
                $cluster['total'] = $total;
                $clusters['all'][$i] = $cluster;
            }
            
            
            for($y = date('Y', time()); $y>=2013; $y--){

                for($i = 1; $i <= 4; $i++) {
                    //$cluster = $Device->countByCluster($i, $group->idgroups);
                    $cluster = $Device->countByCluster($i, $group->idgroups, $y);
                    
                    $total = 0;
                    foreach($cluster as $state){
                        $total += $state->counter;
                    }
                    $cluster['total'] = $total;
                    $clusters[$y][$i] = $cluster;
                }
            }
            $this->set('clusters', $clusters);
            
            // most/least stats for clusters
            $mostleast = array();
            for($i = 1; $i <= 4; $i++){
                $mostleast[$i]['most_seen'] = $Device->findMostSeen(null, $i, $group->idgroups);
                $mostleast[$i]['most_repaired'] = $Device->findMostSeen(1, $i, $group->idgroups);
                $mostleast[$i]['least_repaired'] = $Device->findMostSeen(3, $i, $group->idgroups);
                
            }
            
            $this->set('mostleast', $mostleast);
            
        }
    
    
    }
