<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $middlewares = [];

    // Đăng ký Route GET
    public function get($path, $callback, $middleware = null)
    {
        $this->routes['GET'][$path] = $callback;
        if ($middleware) $this->middlewares['GET'][$path] = $middleware;
    }

    // Đăng ký Route POST
    public function post($path, $callback, $middleware = null)
    {
        $this->routes['POST'][$path] = $callback;
        if ($middleware) $this->middlewares['POST'][$path] = $middleware;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        $basePath = '/web_ban_oc_pro/public';
        $path = str_replace($basePath, '', $path);
        if ($path == '') $path = '/';

        if (isset($this->routes[$method][$path])) {
            // KIỂM TRA MIDDLEWARE Ở ĐÂY
            if (isset($this->middlewares[$method][$path])) {
                $middlewareClass = "App\\Middlewares\\" . $this->middlewares[$method][$path];
                (new $middlewareClass())->handle();
            }

            $callback = $this->routes[$method][$path];
            $this->callAction($callback);
        } else {
            http_response_code(404);
            echo "404 - Trang không tồn tại!";
        }
    }

    private function callAction($callback)
    {
        list($controllerName, $action) = explode('@', $callback);
        $controllerClass = "App\\Controllers\\" . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                die("Action $action không tồn tại trong $controllerClass");
            }
        } else {
            die("Controller $controllerClass không tồn tại");
        }
    }
}
