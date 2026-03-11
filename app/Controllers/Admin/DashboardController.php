<?php
namespace App\Controllers\Admin;

use App\Controllers\HomeController;
use App\Services\CategoryService; 
use App\Services\ProductService;  

class DashboardController extends HomeController {
    protected $categoryService;
    protected $productService;

    public function __construct() {
        $this->categoryService = new CategoryService();
        $this->productService = new ProductService();
    }

    public function index() {
        $totalCategories = $this->categoryService->countAll();
        $totalProducts = $this->productService->listAll(); 
        $data = [
            'total_categories' => $totalCategories,
            'total_products'   => count($totalProducts),
            'user_name'        => $_SESSION['user']['name'] ?? 'Admin'
        ];

        $this->render('admin/dashboard', $data);
    }
}