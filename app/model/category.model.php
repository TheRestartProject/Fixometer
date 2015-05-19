<?php

    class Category extends Model {
        
        protected $table = 'categories';
        private $revision = 1;
        
        public function findAll() {
            
            $sql = 'SELECT * FROM `' . $this->table . '` WHERE `revision` = :rev';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':rev', $this->revision, PDO::PARAM_INT);
            
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (category.model.php, 17)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }

        
        
        public function findAllByRevision($rev) {
            
            $sql = 'SELECT * FROM `' . $this->table . '` WHERE `revision` = :rev';
            $stmt = $this->database->prepare($sql);
            $q = $stmt->execute();
            
            if(!$q){
                new Error(601, 'Could not execute query. (model.class.php, 76)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    