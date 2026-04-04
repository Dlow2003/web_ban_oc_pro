<?php

namespace App\Controllers;

use App\Services\ProductService;
use App\Repositories\UserRepository;

class CartController extends BaseController
{
    protected $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    require_once __DIR__ . '/../../views/client/cart.php';
}

    public function add()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $id = $_POST['id'] ?? null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Không xác định được sản phẩm!']);
        exit;
    }

    if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        $phone = $_POST['phone'] ?? '';
        $inputName = !empty($_POST['name']) ? $_POST['name'] : 'Khách lạ';
        $table = $_POST['table_number'] ?? ''; 
        $address = $_POST['address'] ?? '';     

        if (!empty(trim($phone))) {
            $userRepo = new \App\Repositories\UserRepository();
            $existingUser = $userRepo->findByPhone($phone);

            if ($existingUser) {
                $userId = $existingUser['id'];
                $finalName = $existingUser['name'] ?? $existingUser['username'];
            } else {
                $userId = $userRepo->create([
                    'name' => $inputName,
                    'phone' => $phone,
                    'role' => 'customer',
                    'password' => password_hash('123456', PASSWORD_DEFAULT)
                ]);

                if (!$userId) {
                    echo json_encode(['status' => 'error', 'message' => 'Lỗi: Không thể tạo tài khoản người dùng!']);
                    exit;
                }
                $finalName = $inputName;
            }

            $_SESSION['user'] = [
                'id'    => $userId, 
                'name'  => $finalName,
                'phone' => $phone,
                'table' => $table,    
                'address' => $address,
                'type'  => $_POST['orderType'] ?? 'at_store',
                'role'  => 'customer'
            ];
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập số điện thoại!']);
            exit;
        }
    }

    $product = $this->productService->getById($id);
    if ($product) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'name'     => $product['name'],
                'price'    => $product['price'],
                'image'    => $product['image'],
                'quantity' => $quantity
            ];
        }
        echo json_encode([
            'status'     => 'success',
            'totalItems' => count($_SESSION['cart']),
            'message'    => 'Chào ' . $_SESSION['user']['name'] . ', đã thêm ' . $product['name'] . ' vào giỏ!'
        ]);
    }
    exit;
}
    public function remove() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    
    $id = $_POST['id'] ?? null;
    
    
    if ($id && isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        echo json_encode([
            'status' => 'success',
            'total' => number_format($total, 0, ',', '.') . 'đ',
            'cartEmpty' => empty($_SESSION['cart'])
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy món!']);
    }
    exit;
}
public function update() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $id = $_POST['id'] ?? null;
    $type = $_POST['type'] ?? 'plus';

    if ($id && isset($_SESSION['cart'][$id])) {
        if ($type === 'plus') {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } else {
            if ($_SESSION['cart'][$id]['quantity'] > 1) {
                $_SESSION['cart'][$id]['quantity'] -= 1;
            }
        }

        $itemTotal = $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['quantity'];
        $cartTotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        echo json_encode([
            'status' => 'success',
            'newQty' => $_SESSION['cart'][$id]['quantity'],
            'itemTotal' => number_format($itemTotal, 0, ',', '.') . 'đ',
            'cartTotal' => number_format($cartTotal, 0, ',', '.') . 'đ'
        ]);
    } else {
        echo json_encode(['status' => 'error']);
    }
    exit;
}
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
        // session_destroy(); 
        header('Location: /web_ban_oc_pro/public/');
        exit;
    }
}
