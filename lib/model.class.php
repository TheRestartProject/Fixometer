<?php

    /** Main Model Class
     * exposes the $database var (PDO OBject)
     * to model classes that extend it
     * */

    class Model implements ModelInterface {
        
        protected $database;
        protected $table;
        protected $dates = false;
        
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
        public function findOne($id){
            
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE id' . $this->table . ' = :id';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $q = $stmt->execute();
            
            if(!$q){
                $Error = new Error(601, 'Could not execute query.');
                $Error->display();
                return false;
            }
            else {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            
        }
        
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
        
        public function create($data){
            
            array_filter($data); // remove empty entries. 
            if($this->dates == true){
                $data['created_at'] = date('Y-m-d H:i:s', time() );
            }
            $fields = array_keys($data);
            $holders = array();
            foreach($fields as $i => $field){
                $fields[$i] = '`' . $field . '`';
                $holders[]  = ':' . $field;
            }
            
            $sql = 'INSERT INTO `' . $this->table . '`(' . implode(', ', $fields) .  ') VALUES (' . implode(', ', $holders) . ')';
            
            $stmt = $this->database->prepare($sql);
            
            if(!$stmt && SYSTEM_STATUS == 'development'){
                dbga($this->database->errorInfo());   
            }
            
            foreach($data as $field => &$value){
                $stmt->bindParam(':'.$field, $value, PDO::PARAM_STR);    
            }
            
            $q = $stmt->execute();
            
            if(!$q && SYSTEM_STATUS == 'development'){
                dbga($stmt->errorInfo());
                $response = false;
            }
            else {
                $response = $this->database->lastInsertId();
            }
            
            return $response;
            
        }
        public function update($data, $id){
            
            $fields = array_keys($data);
            $holders = array();
            foreach($fields as $i => $field){
                $fields[$i] = '`' . $field . '` = :' . $field;
            }
            
            $sql = 'UPDATE `' . $this->table . '` SET ' . implode(', ', $fields) . ' WHERE `id' . $this->table . '` = :id'; 
            $stmt = $this->database->prepare($sql);
            if(!$stmt && SYSTEM_STATUS == 'development'){
                dsql($sql);
                dbga($this->database->errorInfo());   
            }
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            foreach($data as $field => &$value){
                if(empty($value) || is_null($value)) { $value == 'NULL'; }
                $g = $stmt->bindParam(':' . $field, $value);
            }
            
            $q = $stmt->execute();
            
            if(!$q && SYSTEM_STATUS == 'development'){
                dbga($stmt->errorInfo());
                $response = false;
            }
            
            else {
                $response = true;
            }
            
            return $response;
        }
        
        public function delete(){}
        
    }
    
    