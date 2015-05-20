<?php

    class Device extends Model {
        
        protected $table = 'devices';
        protected $dates = true;
        
        public function getList(){
            
            $sql = 'SELECT * FROM `view_devices_list`
                    ORDER BY `sorter` DESC';
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }
        
        public function ofThisUser($id){
            $sql = 'SELECT * FROM `' . $this->table . '` WHERE `repaired_by` = :id';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
    }