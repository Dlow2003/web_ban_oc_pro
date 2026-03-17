<?php

namespace App\Controllers;

use App\Services\ProductService;

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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_POST['id'] ?? null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if (!isset($_SESSION['user'])) {
            if (isset($_POST['phone']) && !empty($_POST['phone'])) {
                $_SESSION['user'] = [
                    'name'    => !empty($_POST['name']) ? $_POST['name'] : 'Khách lạ',
                    'phone'   => $_POST['phone'],
                    'address' => $_POST['address'] ?? '',
                    'type'    => $_POST['type'] ?? 'at_store',
                    'table'   => $_POST['table_number'] ?? '',
                    'role'    => 'customer'
                ];
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Vui lòng cung cấp số điện thoại để đặt món!']);
                exit;
            }
        }

        $product = $this->productService->getById($id);

        if ($product) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

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

$displayName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'bạn';
            echo json_encode([
                'status'     => 'success',
                'totalItems' => count($_SESSION['cart']),
                'message'    => 'Đã thêm ' . $product['name'] . '. Chào ' . $displayName . ', món đã vào giỏ!'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Sản phẩm không tồn tại'
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

        // Tính toán lại con số để gửi về cho giao diện
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
