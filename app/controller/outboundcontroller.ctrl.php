<?php
	class OutboundController extends Controller {
		
		
		
		public function __construct($model, $controller, $action){
            parent::__construct($model, $controller, $action);
            $this->groups = new Group;
			$this->parties = new Party;
			$this->devices = new Device;
            
        }
		
		public function index(){
			
			$counters = array();
			$counters['groups'] = $this->groups->howMany();
			$counters['parties'] = $this->parties->howMany();
			$counters['pax'] = $this->parties->attendees();
			
			$allParties = $this->parties->ofThisGroup('admin', true, true);
			$hours_volunteered = 0;
			foreach($allParties as $party){
				$hours_volunteered += (($party->volunteers > 0 ? $party->volunteers * 3 : 12 ) + 9);
			}
			$counters['hours'] = $hours_volunteered;
			
			$counters['devices'] = $this->devices->howMany();
			$counters['statuses'] = $this->devices->statusCount();
			$counters['most_seen'] = $this->devices->findMostSeen();
			
			$rates = array();
			$rates['all'] = $this->devices->successRates();
			for($i = 2014; $i <= date('Y'); $i++) {
				$rates[$i] = $this->devices->successRates($i);
			}
			
			
			$this->set('counters', $counters);
			$this->set('rates', $rates);
			
		}
		
		
		
	}