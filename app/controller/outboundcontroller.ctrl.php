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
			$this->set('counters', $counters);
			
		}
		
		
		
	}