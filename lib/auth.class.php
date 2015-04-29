<?php

    class Auth extends Session {
        
        public $url;
        protected $authorized = false;
        protected $openroutes = array(
                                'user/login',
                                'lol/lol'
                                );
        
        
        
        public function checkRoute($url){
            
            $this->url = $url;
            if(in_array($url, $this->openroutes)){
                $this->authorized = true;
                return true;
            }
            elseif($this->isLoggedIn()){
                $this->authorized = true;
                return true;
            }
            else {
                $this->authorized = false;
                return false;
            }
        }
        
        
        public function isLoggedIn(){
            if(isset($_SESSION['FIXOMETER'][SESSIONKEY]) && !empty($_SESSION['FIXOMETER'][SESSIONKEY])){
                $this->authorized = true;
                return true;
            }
            else {
                $this->authorized = false;
                return false; 
            }
        }
        
       
        public function authorize($user){
            // remember: use crypt($input, $crypted) == $crypted to verify if passwords match
            $Session = new Session;
            $token = $this->token();
            $sessionset = $Session->setSession($user, $token);
            
            $this->authorized = true;
            
            return $sessionset;
        }
        
        private function token(){
            $salt = '$1$' . SESSIONSALT;
            return crypt($token, $salt);
        }
        
        public function getProfile(){
            $session = $this->getSession();
            //print_r($session);
        }
        
    }