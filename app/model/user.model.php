<?php

    class User extends Model {
        
        protected $table = 'users';
        
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
                $Error = new Error(601, 'Could not execute query.');
                $Error->display();
                return false;
            }
            else {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
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
            
            $sql = 'SELECT users.idusers AS id, users.name, users.email, roles.role FROM users
                    INNER JOIN roles ON roles.idroles = users.role
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
        
    }