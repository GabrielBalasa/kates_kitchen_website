<?php
    namespace Ijdb\Controllers;
    class Login
    {
        private $authentication;

        public function __construct(\CSY2028\Authentication $authentication){
            $this->authentication = $authentication;
        }

        public function loginForm(){ //List login form
            return [
                'template' => 'login.html.php',
                'variables' => [],
                'title' => 'Log In'
            ];
        }

        public function processLogin(){ //Login the user after checking credentials
            if ($this->authentication->login($_POST['username'], $_POST['password'])) {
                header('location: /login/success');
            } else {
                return [
                    'template' => 'login.html.php',
                    'title' => 'Log In',
                    'variables' => [
                        'error' => 'Invalid username/password.'
                    ]
                ];
            }
        }

        public function error(){ //Display error if user does access admin areas without loggin in
            return [
                'template' => 'error.html.php',
                'variables' => [],
                'title' => 'You are not logged in'
            ];
        }

        public function success(){ //Successful login
            header('location:/home');
        }

        public function logout(){ //Logout the user
            session_destroy();
            return [
                'template' => 'logout.html.php',
                'variables' => [],
                'title' => 'You have been logged out'
            ];
        }
    }