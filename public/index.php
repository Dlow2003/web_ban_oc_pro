<?php
// 1. Nạp Autoload của Composer (Giúp dùng Namespace thay vì require_once)
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Nạp biến môi trường từ file .env (Bảo mật thông tin DB)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// 3. Khởi tạo Session (Cho Auth và Giỏ hàng)
session_start();

// 4. Import Router
use App\Core\Router;

$router = new Router();

// 5. Định nghĩa các tuyến đường (Routes) - Đây là nơi điều hướng web
$router->get('/', 'HomeController@index');
$router->get('/products', 'ProductController@all');
$router->get('/admin/category/add', 'Admin\CategoryController@add');
$router->post('/admin/category/store', 'Admin\CategoryController@store');

// Trang công khai
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@postLogin');

// Trang cần đăng nhập mới vào được (Sử dụng AuthMiddleware)
$router->get('/admin/dashboard', 'Admin\DashboardController@index', 'AuthMiddleware');
$router->get('/admin/category/add', 'Admin\CategoryController@add', 'AuthMiddleware');

// 6. Chạy hệ thống
$router->run();