<?php
namespace App\Controllers\Admin;

use App\Controllers\HomeController;

class DashboardController extends HomeController {
    public function index() {
        // Sau này bạn có thể lấy số lượng ốc, đơn hàng từ Service để hiển thị ở đây
        $data = [
            'total_categories' => 10, // Giả lập dữ liệu
            'user_name' => $_SESSION['user']['name'] ?? 'Admin'
        ];

        $this->render('admin/dashboard', $data);
    }
}