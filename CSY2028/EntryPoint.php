<?php 
    namespace CSY2028;
    class EntryPoint
    {
        private $routes;
        private $authentication;

        public function __construct(\CSY2028\Routes $routes) {
            $this->routes = $routes;
        }

        public function run()
        {
            $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
            $routes = $this->routes->getRoutes();
            $method = $_SERVER['REQUEST_METHOD'];
            $authentication = $this->routes->authentication();

            if (isset($routes[$route]['login']) && !$authentication->loggedIn()) {
                header('location: /login/error');
            }
            else if (isset($routes[$route]['permissions']) && !$this->routes->checkPermission
                ($$routes[$route]['permissions'])) {
                header('location: /login/error');
            }
            else {
                $controller = $routes[$route][$method]['controller'];
                $functionName = $routes[$route][$method]['function'];
                $page = $controller->$functionName();
                $output = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);
                $title = $page['title'];
                $layoutVariables = $this->routes->getLayoutVariables();
                extract($layoutVariables);
                require '../templates/layout.html.php';
            }
        }

        public function loadTemplate($fileName, $templateVariables=[]){
            extract($templateVariables);
            ob_start();
            require $fileName;
            $output = ob_get_clean();
            return $output;
        }
    }