<?php

    class Party extends Model {
        
        protected $table = 'events';     
        protected $dates = true;
        
        public function findAll() {
            
            $sql = 'SELECT
                        `e`.`idevents` AS `id`,
                        UNIX_TIMESTAMP(`e`.`start`) AS `start`,
                        UNIX_TIMESTAMP(`e`.`end`) AS `end`,
                        `e`.`location`,
                        `e`.`latitude`,
                        `e`.`longitude`,
                        `e`.`pax`,
                        `g`.`name` AS `group_name`,
                        `u`.`name` AS `host_name`
                    FROM `events` AS `e`
                    INNER JOIN `groups` AS `g`
                        ON `g`.`idgroups` = `e`.`group`
                    LEFT JOIN `users` AS `u`
                        ON `u`.`group` = `e`.`group`
                    ORDER BY `e`.`start` DESC';
                    
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    } 