<?php

    class User extends Model {
        
        protected $table = 'users';
        protected $dates = true;
        
        
        
        public function find($params){
            $sql = 'SELECT * FROM ' . $this->table . '
                    INNER JOIN roles ON roles.idroles = ' . $this->table . '.role
                    WHERE ';
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
                new Error(601, 'Could not execute query. (user.model.php, 29)');
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }
        
        public function getUserGroups($user){
            $sql = 'SELECT * FROM `' . $this->table . '` AS `u` 
                    INNER JOIN `users_groups` AS `ug` ON `ug`.`user` = `u`.`idusers`
                    INNER JOIN `groups` AS `g` ON `ug`.`group` = `g`.`idgroups` 
                    WHERE `u`.`idusers` = :id';
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':id', $user, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);        
            
            
        }
        
        public function getRolePermissions($role){
            $sql = 'SELECT p.idpermissions, p.permission, r.idroles, r.role FROM permissions AS p 
                    INNER JOIN roles_permissions AS rp ON rp.permission = p.idpermissions
                    INNER JOIN roles AS r ON rp.role= r.idroles 
                    WHERE r.role = :role';
                    
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function getUserList () {
            
            $sql = 'SELECT users.idusers AS id, users.name, users.email, roles.role, UNIX_TIMESTAMP(sessions.modified_at) AS modified_at FROM users
                    INNER JOIN roles ON roles.idroles = users.role
                    INNER JOIN sessions ON sessions.user = users.idusers 
                    ORDER BY users.role ASC';
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            $Users = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if(is_array($Users)){
                
                
                $User = new User;
                foreach($Users as $key => $user) {
                    
                    $Users[$key]->permissions = $User->getRolePermissions($user->role);
                }
            }
            return $Users;
        }
        
        public function create($data){
            $sql = 'INSERT INTO `' . $this->table . '` (`created_at`, `name`, `email`, `password`, `role`)
                    VALUES (:created_at, :name, :email, :password, :role)';
            
            $data['created_at'] = date('Y-m-d H:i:s', time() );
            
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':role', $data['role'], PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $data['created_at']);
            
            $q = $stmt->execute();
            
            if(!$q){
                $einfo = $stmt->errorInfo();
                $response = false;
                new Error(602, $einfo[2]);
            }
            else {
                $response = $this->database->lastInsertId();
            }
            
            return $response;
        }
        
    }