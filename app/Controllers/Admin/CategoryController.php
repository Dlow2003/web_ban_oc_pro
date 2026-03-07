<?php

namespace App\Controllers\Admin;

use App\Controllers\HomeController;
use App\Services\CategoryService;

class CategoryController extends HomeController
{
    private $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    public function index()
    {
        $categories = $this->service->getList();
        $this->render('admin/category/index', ['categories' => $categories]);
    }

    public function add() {
    $this->render('admin/category/add');
}

public function store() {
    // Kiểm tra xem có phải là request POST không
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $this->service->storeCategory($_POST);
            
            header('Location: /web_ban_oc_pro/public/admin/category?msg=added');
            exit();

        } catch (\Exception $e) {
            
            $this->render('admin/category/add', [
                'error' => 'Tên danh mục này đã tồn tại, vui lòng chọn tên khác!'
            ]);
        }
    }
}
    public function delete($id)
    {
        $result = $this->service->deleteCategory($id);

        if ($result) {
            header('Location: /web_ban_oc_pro/public/admin/category?msg=deleted');
        } else {
            die("Lỗi khi xóa danh mục!");
        }
    }
    public function edit($id)
    {
        $category = $this->service->getById($id);
        if (!$category) die("Không tìm thấy danh mục!");

        $this->render('admin/category/edit', ['category' => $category]);
    }

   public function update($id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $this->service->updateCategory($id, $_POST);
            
            header('Location: /web_ban_oc_pro/public/admin/category?msg=updated');
            exit();
            
        } catch (\Exception $e) {
            $category = $this->service->getById($id);
            $this->render('admin/category/edit', [
                'category' => $category,
                'error' => 'Tên này đã tồn tại hoặc trùng với danh mục khác!'
            ]);
        }
    }
}
}
