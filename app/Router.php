<?php
class Router {
    private $routes = [];

    public function add($method, $route, $action) {
        $this->routes[$method][$this->formatRoute($route)] = $action;
    }

    private function formatRoute($route) {
        $result = preg_replace('/\//', '\\/', $route);
        $result = preg_replace('/\{([a-z]+)\}/', '(?<$1>[^\/]+)', $result);
        return '/^' . $result . '$/i';
    }

    public function dispatch($url) {
        $method = $_SERVER['REQUEST_METHOD'];
        $found = false;

        foreach ($this->routes[$method] ?? [] as $route => $action) {
            if (preg_match($route, $url, $matches)) {
                $found = true;
                $action = explode('@', $action);
                $controllerName = $action[0] . 'Controller';
                $actionName = $action[1];

                require_once "../app/controllers/$controllerName.php";
                $controller = new $controllerName();

                if (method_exists($controller, $actionName)) {
                    call_user_func_array([$controller, $actionName], [$matches]);
                } else {
                    echo "404 Not Found";
                }
                break;
            }
        }

        if (!$found) {
            echo "404 Not Found";
        }
    }
}
