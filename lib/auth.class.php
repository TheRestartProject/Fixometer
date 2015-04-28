<?php

    class Auth {
        
        public $url;
        protected $authorized = false;
        protected $openroutes = array(
                                'user/login',
                                'lol/lol'
                                );
        
        public function __construct($url){
            $this->url = $url;
            if(in_array($url, $this->openroutes)){
                $this->authorized = true;
            }
        }
        
        public function verify() {
            if($this->authorized == true){
                return true;    
            }
            else {
                if(isset($_SESSION[SESSIONKEY][SESSIONNAME]) && !empty($_SESSION[SESSIONKEY][SESSIONNAME])){
                    return true;
                }
                else {
                    return false;
                }
                
            }
        }
        
        public function authorize($name, $password){
            // remember: use crypt($input, $crypted) == $crypted to verify if passwords match
            
        }
        
    }