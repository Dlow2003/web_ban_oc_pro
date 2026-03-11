<?php
require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


session_start();


use App\Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
//$router->get('/', 'HomeController@index', 'RateLimitMiddleware');
$router->get('/products', 'ProductController@all');
$router->get('/admin/category/add', 'Admin\CategoryController@add');
$router->post('/admin/category/store', 'Admin\CategoryController@store');
$router->get('/admin/category', 'Admin\CategoryController@index', 'AuthMiddleware');

// Đăng Nhập đăng ký
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@postLogin');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

$router->get('/menu', 'HomeController@menu');

// Quản lý danh mục (Admin)
$router->get('/admin/category', 'Admin\CategoryController@index', 'AuthMiddleware');
$router->post('/admin/category/store', 'Admin\CategoryController@store', 'AuthMiddleware');
$router->get('/admin/dashboard', 'Admin\DashboardController@index', 'AuthMiddleware');
$router->get('/admin/category/add', 'Admin\CategoryController@add', 'AuthMiddleware');
$router->get('/admin/category', 'Admin\CategoryController@index');

$router->get('/admin/product', 'Admin\ProductController@index');

$router->get('/admin/product/add', 'Admin\ProductController@add');
$router->post('/admin/product/store', 'Admin\ProductController@store');
$router->get('/admin/product/edit/(\d+)', 'Admin\ProductController@edit');
$router->post('/admin/product/update', 'Admin\ProductController@update');
$router->get('/admin/product/delete/(\d+)', 'Admin\ProductController@delete');

// Trang delete
$router->get('/admin/category/delete/([0-9]+)', 'Admin\CategoryController@delete', 'AuthMiddleware');
// Trang chỉnh sửa (GET)
$router->get('/admin/category/edit/([0-9]+)', 'Admin\CategoryController@edit');
$router->get('/admin/product/edit/(\d+)', 'Admin\ProductController@edit');
$router->post('/admin/product/update', 'Admin\ProductController@update');

// Xử lý cập nhật (POST)
$router->get('/admin/category/add', 'Admin\CategoryController@add');
$router->post('/admin/category/store', 'Admin\CategoryController@store');
$router->get('/admin/category/edit/(\d+)', 'Admin\CategoryController@edit');
$router->post('/admin/category/update', 'Admin\CategoryController@update');
$router->run();