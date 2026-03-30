<?php
namespace App\Controllers;

class BaseController {
    
    public function render($view, $data = []) {
        // Trích xuất mảng dữ liệu thành các biến 
        extract($data);

        $viewPath = __DIR__ . '/../../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View không tồn tại: " . $view);
        }
    }
}