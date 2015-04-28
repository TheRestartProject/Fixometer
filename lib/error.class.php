<?php

    class Error {
        
        public $error_Code;
        public $error_Message;
        public $error_Severity;
        
        public function __construct($code, $message) {
            
            $this->error_Code = $code;
            $this->error_Message = $message;
            if ($this->error_Code < 200) {
                $this->error_Severity = 'Notice';
            }
            elseif ($this->error_Code < 500 && $this->error_Code >= 200 ) {
                $this->error_Severity = 'Warning';
            }
            else {
                $this->error_Severity = 'Fatal';
            }
        }
        
        public function display(){
            
            echo $this->error_Message;
            
            
        }
    }