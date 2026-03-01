<?php
namespace App\Middlewares;

class AuthMiddleware {
    public function handle() {
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, đá về trang login
            header('Location: /web_ban_oc_pro/public/login');
            exit();
        }
    }

    public function isAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Bạn không có quyền truy cập trang này!");
        }
    }
}