<?php

    class Role extends Model {
        
        protected $table = 'roles';
        
        
        /**
         * Extended to include connected permissions
         * and display all data (users too)
         * */
        public function findAll() {
            
            $sql = 'SELECT
                        `r`.`idroles` AS `id`,
                        `r`.`role` AS `role`,
                        GROUP_CONCAT(`p`.`permission` ORDER BY `p`.`permission` ASC SEPARATOR ", "  )  as `permissions_list`
                    FROM `' . $this->table . '` AS `r`
                    LEFT JOIN `roles_permissions` AS `rp` ON `r`.`idroles` = `rp`.`role`
                    LEFT JOIN `permissions` AS `p` ON `rp`.`permission` = `p`.`idpermissions`
                    GROUP BY `r`.`idroles` 
                    ORDER BY `r`.`idroles` ASC';
                    
            $stmt = $this->database->prepare($sql);
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }
    }
    