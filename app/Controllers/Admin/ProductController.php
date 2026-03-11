<?php
namespace App\Controllers\Admin;

use App\Controllers\HomeController;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends HomeController {
    protected $productService;
    protected $categoryService;

    public function __construct() {
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
    }

    public function index() {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 6; 
    $paginationData = $this->productService->getAdminPaginated($page, $perPage);

    $this->render('admin/product/index', [
        'products' => $paginationData['products'],
        'totalPages' => $paginationData['totalPages'],
        'currentPage' => $paginationData['currentPage']
    ]);
}

    public function add() {
        $categories = $this->categoryService->getList(); 
        $this->render('admin/product/add', ['categories' => $categories]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->productService->saveProduct($_POST, $_FILES['image']);
            header('Location: /web_ban_oc_pro/public/admin/product?msg=added');
        }
    }
    
    
    public function delete($id)
{
    $result = $this->productService->removeProduct($id);

    if ($result) {
        header('Location: /web_ban_oc_pro/public/admin/product?msg=deleted');
        exit();
    } else {
        die("Lỗi: Không thể xóa sản phẩm này!");
    }
}
public function edit($id) {
    $product = $this->productService->getProduct($id);
    $categories = $this->categoryService->getList();
    
    if (!$product) {
        header('Location: /web_ban_oc_pro/public/admin/product?error=notfound');
        exit();
    }
    
    $this->render('admin/product/edit', [
        'product' => $product,
        'categories' => $categories
    ]);
}

public function update() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $data = [
            'category_id' => $_POST['category_id'],
            'name'        => $_POST['name'],
            'price'       => $_POST['price'],
            'description' => $_POST['description'],
            'status'      => $_POST['status']
        ];
        
        $file = $_FILES['image'];
        $this->productService->updateProduct($id, $data, $file);
        
        header('Location: /web_ban_oc_pro/public/admin/product?msg=updated');
        exit();
    }
}
}