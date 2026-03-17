<?php
namespace App\Controllers; 
use App\Services\ProductService;

class ProductController extends HomeController {
    protected $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function detail($id) {
        $product = $this->productService->getById($id);
        
        if (!$product) {
            header('Location: /web_ban_oc_pro/public/');
            exit;
        }

        $data = [
            'title' => 'Chi tiết: ' . $product['name'],
            'product' => $product,
            'relatedProducts' => $this->productService->getRelated($product['category_id'], $id)
        ];

        // Trả về view 
        $this->render('client/product_detail', $data);
    }
}