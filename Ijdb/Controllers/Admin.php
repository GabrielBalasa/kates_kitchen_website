<?php
    namespace Ijdb\Controllers;
    class Admin
    {
        private $authentication;
        private $usersTable;

        public function __construct(\CSY2028\Authentication $authentication, $usersTable){
            $this->authentication = $authentication;
            $this->usersTable = $usersTable;
        }

        public function validateRegistration($account) { //Initiate errors to validate registration 
            $errors = [];
            if ($account['username'] == '') {
                $errors[] = 'You must enter a username';
            }

            if ($account['password'] == '') {
                $errors[] = 'You must enter a password';
            }
            return $errors;
        }

        public function registrationForm($errors=[]){ //Display registration form
            $user = $this->authentication->getUser();
            $account = $_POST['account'] ?? [];
            return [
                'template' => 'register.html.php',
                'variables' => [
                    'user' => $user,
                    'errors' => $errors,
                    'account' => $account
                ],
                'title' => 'Create an account'
            ];
        }

        public function registerUser(){ //Register user if there are no errors
            $user = $this->authentication->getUser();
            if (!$user->getPermission(\Ijdb\Entity\User::ADD_ACCOUNTS)){
                return;
            }
            $account = $_POST['account'];
            $errors = $this->validateRegistration($account);

            if (count($errors) == 0){
                $account['password'] = password_hash($account['password'],PASSWORD_DEFAULT);
                $this->usersTable->save($account);
                header('Location: /registration/success');
            }
            else{
                return  $this->registrationForm($errors);
            }
        }

        public function registrationSuccess(){
            return ['template' => 'registrationsuccess.html.php',
                'variables' => [],
                'title' => 'Registration Successful'];
        }

        public function permissions(){ //Check logged in user's permissions
            $user = $this->authentication->getUser();
            $users = $this->usersTable->find('id', $_GET['id'])[0];
            $reflected = new \ReflectionClass('\Ijdb\Entity\User');
            $constants = $reflected->getConstants();
            return ['template' => 'accountpermissions.html.php',
                'title' => 'Edit Permissions',
                'variables' => [
                    'users' => $users,
                    'user' => $user,
                    'permission' => $constants
                ]
            ];
        }

        public function savePermissions(){ //Change edited user's permissions
            $user = $this->authentication->getUser();
            if (!$user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)) {
                return;
            }
            $users = [
                'id' => $_POST['id'],
                'permission' => array_sum($_POST['permission'] ?? [])
            ];
            $this->usersTable->update($users);
            header('location: /accounts/admin');
        }

        public function manageAdmins(){ //Manage admin accounts
            $user = $this->authentication->getUser();
            $users = $this->usersTable->find('role', 'admin');
            return [ 'template' => 'adminaccounts.html.php',
                'title' => 'Manage admin accounts',
                'variables' => [
                    'users' => $users,
                    'user' => $user
                ]
            ];
        }

        public function delete(){ //Delete account
            $user = $this->authentication->getUser();
            $account = $this->usersTable->find('id', $_POST['id'])[0];
            if (!$user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)) {
                return;
            }
            $this->usersTable->delete($account->id);
            header('location: /accounts/admin');
        }
    }