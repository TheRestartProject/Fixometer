<?php

    class Party extends Model {
        
        protected $table = 'events';     
        protected $dates = true;
        
        public function findAll() {
            
            $sql = 'SELECT
                        `e`.`idevents` AS `id`,
                        UNIX_TIMESTAMP(`e`.`event_date`) AS `event_date`,
                        `e`.`start` AS `start`,
                        `e`.`end` AS `end`,
                        `e`.`location`,
                        `e`.`latitude`,
                        `e`.`longitude`,
                        `e`.`pax`,
                        `e`.`hours`,
                        `g`.`name` AS `group_name`                        
                    FROM `events` AS `e`
                    INNER JOIN `groups` AS `g`
                        ON `g`.`idgroups` = `e`.`group`
                    ORDER BY `e`.`start` DESC';
                    
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function createUserList($party, $users){
            /** reset user list **/
            if(!self::deleteUserList($party)){
                return false;    
            }
            $sql = 'INSERT INTO `events_users`(`event`, `user`) VALUES (:party, :user)';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':party', $party, PDO::PARAM_INT);
            foreach($users as $k => &$user){
                $stmt->bindParam(':user', $user, PDO::PARAM_INT);
                
                $q = $stmt->execute();
                if(!$q){
                    if(SYSTEM_STATUS == 'development'){
                        $err = $stmt->errorInfo();
                        new Error(601, $err[2]);
                    }
                }
            }
        }
        
        public function deleteUserList($party){
            $sql = 'DELETE FROM `events_users` WHERE `event` = :party';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':party', $party, PDO::PARAM_INT);
            return $stmt->execute();
        }
        
        public function ofThisUser($id){
            $sql = 'SELECT * FROM `' . $this->table . '` AS `e` 
                    INNER JOIN `events_users` AS `eu` ON `eu`.`event` = `e`.`idevents`
                    INNER JOIN `groups` as `g` ON `e`.`group` = `g`.`idgroups` 
                    WHERE `eu`.`user` = :id
                    ORDER BY `e`.`event_date` DESC';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $q = $stmt->execute();
            if(!$q){
                if(SYSTEM_STATUS == 'development'){
                    $err = $stmt->errorInfo();
                    new Error(601, $err[2]);
                }
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    
    
    