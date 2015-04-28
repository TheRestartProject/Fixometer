<?php

    /** Main Model Class
     * exposes the $database var (PDO OBject)
     * to model classes that extend it
     * */

    class Model implements ModelInterface {
        
        protected $database;
        protected $table;
        
        public function __construct() {
            if(!$this->handle){
                
                $dns = DBTYPE . ':dbname=' . DBNAME . ';host=' . DBHOST;
                
                $this->database = new PDO($dns, DBUSER, DBPASS);
                if (is_object($this->database)) {
                    $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    return $this->database;
                }
                else {
                    return false;
                }
            }
            
        }
        
        public function find($params){}
        public function findOne($id){}
        public function findAll(){}
        
        public function create(){}
        public function update(){}
        
        public function delete(){}
        
    }