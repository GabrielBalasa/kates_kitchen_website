<?php
    namespace CSY2028;
    class Authentication
    {
        private $usersTable;
        private $usernameField;
        private $passwordField;

        public function __construct(DatabaseTable $usersTable, $usernameField, $passwordField)
        {
            session_start();
            $this->usersTable = $usersTable;
            $this->usernameField = $usernameField;
            $this->passwordField = $passwordField;
        }

        public function login($username, $password)
        {
            $user = $this->usersTable->find($this->usernameField, $username);
                //Code from PHP & MySQL: Novice to Ninja 6th Edition
            if (!empty($user) && password_verify($password, $user[0]->{$this->passwordField})) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $user[0]->{$this->passwordField};
                return true;
            } else {
                return false;
            }
        }


        public function loggedIn()
        {
            if (empty($_SESSION['username'])) {
                return false;
            }
            //Code from PHP & MySQL: Novice to Ninja 6th Edition
            $user = $this->usersTable->find($this->usernameField, $_SESSION['username']);
            $passwordField = $this->passwordField;
            if (!empty($user) && $user[0]->$passwordField === $_SESSION['password']) {
                return true;
            } else {
                return false;
            }
        }
        
        public function getUser() {
            if ($this->loggedIn()) {
                return $this->usersTable->find($this->usernameField, ($_SESSION['username']))[0];
            }
            else {
                return false;
            }
        }
    }