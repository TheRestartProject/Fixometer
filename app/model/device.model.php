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
        
    }