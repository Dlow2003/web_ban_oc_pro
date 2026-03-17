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

    public function index() {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
    $keyword = isset($_GET['search']) ? trim($_GET['search']) : null; 

    $paginationData = $this->productService->getPaginated($page, 9, $categoryId, $keyword); 

    $data = [
        'title' => 'Ốc Ngon VKU - Kết quả tìm kiếm',
        'categories' => $this->categoryService->getList(),
        'products' => $paginationData['products'],
        'totalPages' => $paginationData['totalPages'],
        'currentPage' => $page,
        'currentCategory' => $categoryId,
        'keyword' => $keyword 
    ];

    $this->render('client/home', $data);
}
public function searchApi() {
    $keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
    $products = [];

    if (strlen($keyword) >= 2) {
        $result = $this->productService->getPaginated(1, 5, null, $keyword);
        $products = $result['products'];
    }
    if (empty($products)) {
        return; 
    }
        foreach ($products as $item) {
    $imgPath = "/web_ban_oc_pro/public/assets/uploads/products/" . $item['image'];

    echo '
    <a href="?search=' . urlencode($item['name']) . '" class="list-group-item list-group-item-action d-flex align-items-center">
        <img src="' . $imgPath . '" style="width:45px; height:45px; object-fit:cover;" class="rounded me-3 shadow-sm">
        <div>
            <div class="fw-bold small text-dark">' . htmlspecialchars($item['name']) . '</div>
            <div class="text-danger small fw-bold">' . number_format($item['price'], 0, ',', '.') . 'đ</div>
        </div>
    </a>';
}
    exit;
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
