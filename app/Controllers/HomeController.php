<?php
namespace App\Controllers;

use App\Services\CategoryService;

class HomeController {
    public function index() {
    $categoryService = new \App\Services\CategoryService();
    $categories = $categoryService->getList(); 

    $data = [
        'title' => 'Ốc Ngon VKU - Đặt là có!',
        'slogan' => 'Hải sản tươi sống - Giao hàng thần tốc',
        'categories' => $categories
    ];

    $this->render('client/home', $data);
}

    public function menu() {
        $service = new CategoryService();
        $categories = $service->getList(); 

        $data = [
            'title' => 'Thực đơn Quán Ốc ',
            'categories' => $categories 
        ];

        $this->render('client/menu', $data);
    }

    protected function render($view, $data = []) {
        extract($data); 
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view không tồn tại!");
        }
    }
}