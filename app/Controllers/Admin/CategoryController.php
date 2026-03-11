<?php

namespace App\Controllers\Admin;

use App\Controllers\HomeController;
use App\Services\CategoryService;

class CategoryController extends HomeController
{
    // Đổi tên thành $categoryService cho rõ nghĩa và đồng bộ với các hàm bên dưới
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $categories = $this->categoryService->getList();
        $this->render('admin/category/index', ['categories' => $categories]);
    }

    public function add() 
    {
        $this->render('admin/category/add');
    }

    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $this->categoryService->storeCategory($_POST);
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
        $result = $this->categoryService->deleteCategory($id);
        if ($result) {
            header('Location: /web_ban_oc_pro/public/admin/category?msg=deleted');
            exit();
        } else {
            die("Lỗi khi xóa danh mục!");
        }
    }

    public function edit($id)
    {
        $category = $this->categoryService->getById($id);
        if (!$category) die("Không tìm thấy danh mục!");

        $this->render('admin/category/edit', ['category' => $category]);
    }

    public function update() 
    { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID từ input hidden trong form gửi lên
            $id = $_POST['id'] ?? null; 
            
            $data = [
                'name'        => $_POST['name'],
                'description' => $_POST['description'],
                'status'      => $_POST['status']
            ];

            // Đã sửa lỗi: Dùng $this->categoryService thay vì $this->service
            $result = $this->categoryService->updateCategory($id, $data);

            if ($result) {
                header('Location: /web_ban_oc_pro/public/admin/category?msg=updated');
                exit();
            } else {
                die("Cập nhật thất bại!");
            }
        }
    }
}