<?php
namespace App\Controllers;

class AuthController extends HomeController {
    public function login() {
        $this->render('auth/login');
    }

    public function postLogin() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Giả lập check login (Sau này sẽ dùng UserRepository)
        if ($email === 'admin@gmail.com' && $password === '123') {
            $_SESSION['user'] = [
                'name' => 'Admin VKU',
                'role' => 'admin'
            ];
            header('Location: /web_ban_oc_pro/public/admin/dashboard');
        } else {
            die("Sai thông tin đăng nhập!");
        }
    }
}