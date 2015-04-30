<?php

    /** Main Model Class
     * exposes the $database var (PDO OBject)
     * to model classes that extend it
     * */

    class Model implements ModelInterface {
        
        protected $database;
        protected $table;
        
        public function __construct() {
            if(!$this->database){
                
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
        
        public function find($params){
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';
            $clauses = array();
            foreach($params as $field => $value) {
                $clauses[] = $field . ' = :' . $field;
            }
            $sql .= implode(' AND ', $clauses);
            
            $stmt = $this->database->prepare($sql);
            foreach($params as $field => &$value){
                $stmt->bindParam(':'.$field, $value);
            }
            $q = $stmt->execute();
            
            if(!$q){
                $Error = new Error(601, 'Could not execute query.');
                $Error->display();
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        public function findOne($id){}
        
        public function findAll(){
            $sql = 'SELECT * FROM ' . $this->table;
            $stmt = $this->database->prepare($sql);
            $q = $stmt->execute();
            
            if(!$q){
                $Error = new Error(601, 'Could not execute query.');
                $Error->display();
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            
        }
        
        public function create($data){}
        public function update(){}
        
        public function delete(){}
        
    }