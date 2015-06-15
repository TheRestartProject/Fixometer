<?php

    class Group extends Model {
        
        protected $table = 'groups';
        protected $dates = true;
        
        public function findAll() {
            $sql =  'SELECT
                        `g`.`idgroups` AS `id`,
                        `g`.`name` AS `name`,
                        `g`.`location` AS `location`,
                        `g`.`latitude` AS `latitude`,
                        `g`.`longitude` AS `longitude`, 
                        `g`.`area` AS `area`,
                        `g`.`frequency` AS `frequency`, 
                        GROUP_CONCAT(`u`.`name` ORDER BY `u`.`name` ASC SEPARATOR ", "  )  AS `user_list`
                    FROM `' . $this->table . '` AS `g`
                    LEFT JOIN `users_groups` AS `ug` ON `g`.`idgroups` = `ug`.`group`
                    LEFT JOIN `users` AS `u` ON `ug`.`user` = `u`.`idusers`
                    GROUP BY `g`.`idgroups` 
                    ORDER BY `g`.`idgroups` ASC';
            $stmt = $this->database->prepare($sql);
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function ofThisUser($id){
            $sql = 'SELECT * FROM `' . $this->table . '` AS `g` 
                    INNER JOIN `users_groups` AS `ug`
                        ON `ug`.`group` = `g`.`idgroups`
                    WHERE `ug`.`user` = :id';
                    
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }