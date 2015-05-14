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
                        `g`.`name` AS `group_name`                        
                    FROM `events` AS `e`
                    INNER JOIN `groups` AS `g`
                        ON `g`.`idgroups` = `e`.`group`
                    ORDER BY `e`.`start` DESC';
                    
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    } 