<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;

class HomeController
{
    protected $categoryService;
    protected $productService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->productService = new ProductService();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
        

        if ($page < 1) $page = 1;

        $paginationData = $this->productService->getPaginated($page, 8, $categoryId);

        $data = [
            'title' => 'Ốc Ngon VKU - Đặt là có!',
            'categories' => $this->categoryService->getList(),
            'products' => $paginationData['products'],
            'totalPages' => $paginationData['totalPages'],
            'currentPage' => $paginationData['currentPage'],
            'currentCategory' => $categoryId 
        ];

        $this->render('client/home', $data);
    }



    public function menu()
    {
        $categories = $this->categoryService->getList();
        $products = $this->productService->listAll();

        $data = [
            'title' => 'Thực đơn Quán Ốc',
            'categories' => $categories,
            'products' => $products
        ];

        $this->render('client/menu', $data);
    }

    protected function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view không tồn tại!");
        }
    }
}
