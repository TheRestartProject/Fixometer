<?php

    class UserController extends Controller {
        
        
        public function login(){
            
            $this->set('title', 'Login');
            
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                
                $response = array();
                
                $uput_email = $_POST['email'];
                $uput_password = $_POST['password'];
                
                if(empty($uput_email) || !filter_var($uput_email, FILTER_VALIDATE_EMAIL)){
                    $response['danger']['email'] = '<strong>Invalid/Empty email</strong>. Please input a valid email address.';
                }
                if(empty($uput_password)){
                    $response['danger']['password'] = '<strong>Empty Password</strong>. Please input a password.';
                }
                
                if(!isset($response['danger'])){
                    // No errors, we can proceed and see if we can auth this guy here.
                    $user = $this->User->find(array(
                                                    'email' => $uput_email,
                                                    'password' => crypt($uput_password, '$1$' . SECRET)
                                                )
                                            );
                    
                    if(!empty($user)){
                        $Auth = new Auth;
                        if(!$Auth->isLoggedIn()){
                            
                            $pass = $Auth->authorize($user[0]->idusers);
                            
                        }
                        else {
                            $pass = true;
                        }
                        
                        if($pass == true){
                            header('Location: /dashboard');
                        }
                    }
                    else {
                        $this->set('response', array('danger' => array('No correspondance.')));
                        header('Location: /user/login');
                    }
                }
                else {
                    $this->set('response', $response);
                }
            }
        }
        
        
        public function all() {
            $this->set('title', 'Users');
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
                if(hasRole($user, 'Administrator')){
                    $userlist = $this->User->getUserList();
                    $this->set('userlist', $userlist);
                }
                else {
                    header('Location: /user/forbidden', true, 404);
                }
            }
        }
        
        public function create() {
            $this->set('title', 'New User');
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
                if(hasRole($user, 'Administrator')){
                    
                    $Roles = new Role;
                    $Roles =$Roles->findAll();
                    
                    $this->set('roles', $Roles);
                    
                }
                else {
                    header('Location: /user/forbidden', true, 404);
                }
            }
            
        }
        
    }
    