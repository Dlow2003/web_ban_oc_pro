<?php
namespace App\Core;

class Router
{
    private $routes = [];
    private $middlewares = [];

    public function get($path, $callback, $middleware = null)
    {
        $this->routes['GET'][$path] = $callback;
        if ($middleware) $this->middlewares['GET'][$path] = $middleware;
    }

    public function post($path, $callback, $middleware = null)
    {
        $this->routes['POST'][$path] = $callback;
        if ($middleware) $this->middlewares['POST'][$path] = $middleware;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = str_replace('/index.php', '', $scriptName);
        
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }
        
        if ($path == '' || $path == '/') $path = '/';

        foreach ($this->routes[$method] as $routePath => $callback) {
            $pattern = "#^" . $routePath . "$#";
            
            if (preg_match($pattern, $path, $matches)) {
                if (isset($this->middlewares[$method][$routePath])) {
                    $middlewareClass = "App\\Middlewares\\" . $this->middlewares[$method][$routePath];
                    (new $middlewareClass())->handle();
                }

                array_shift($matches); 
                $this->callAction($callback, $matches);
                return; 
            }
        }

        http_response_code(404);
        echo "404 - Không tìm thấy đường dẫn: " . $path;
    }

    private function callAction($callback, $params = [])
    {
        list($controllerName, $action) = explode('@', $callback);
        $controllerClass = "App\\Controllers\\" . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
            } else {
                die("Action $action không tồn tại trong $controllerClass");
            }
        } else {
            die("Controller $controllerClass không tồn tại");
        }
    }
}