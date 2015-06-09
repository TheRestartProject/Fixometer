<?php

    class RssController extends Controller {
        
        
        
        public function parties() {
            $Parties = new Party;
            $this->set('parties', $Parties->findAll());
            
        }
        
        
    }
    