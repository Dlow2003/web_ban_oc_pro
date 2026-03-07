<?php
namespace App\Controllers;

use App\Services\AuthService;

class AuthController extends HomeController {
    protected $authService;

    public function __construct() {
        // Khởi tạo AuthService để giải quyết lỗi báo đỏ
        $this->authService = new AuthService();
    }

    public function login() {
        $this->render('auth/login');
    }

    public function postLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Sử dụng AuthService để kiểm tra đăng nhập thật từ Database
            $user = $this->authService->login($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id'   => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role']
                ];

                // Phân quyền: Admin vào Dashboard, User về trang chủ
                if ($user['role'] === 'admin') {
                    header('Location: /web_ban_oc_pro/public/admin/dashboard');
                } else {
                    header('Location: /web_ban_oc_pro/public/');
                }
                exit();
            } else {
                // Trả về view login kèm thông báo lỗi
                $this->render('auth/login', ['error' => 'Email hoặc mật khẩu không chính xác!']);
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name'     => $_POST['name'],
                'email'    => $_POST['email'],
                // Sử dụng password_hash để bảo mật mật khẩu
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role'     => 'user' 
            ];

            $result = $this->authService->createUser($data);

            if ($result) {
                header('Location: /web_ban_oc_pro/public/login?msg=reg_success');
                exit();
            } else {
                $this->render('auth/register', ['error' => 'Email đã tồn tại!']);
            }
        } else {
            $this->render('auth/register');
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /web_ban_oc_pro/public/login');
        exit();
    }
}