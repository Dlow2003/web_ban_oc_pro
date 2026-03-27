<?php
namespace App\Controllers;

use App\Repositories\OrderRepository;

class OrderController {
    
    public function checkout() {
        header('Content-Type: application/json');

        if (empty($_SESSION['cart'])) {
            echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng của Dat đang trống!']);
            return;
        }

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $user = $_SESSION['user'] ?? null;

        $data = [
            'user_id'          => $user['id'] ?? null,
            'customer_name'    => $user['fullname'] ?? $user['name'] ?? 'Khách vãng lai',
            'customer_phone'   => $user['phone'] ?? null,
            'customer_email'   => $user['email'] ?? null,
            'shipping_address' => $_POST['address'] ?? 'Tại quán',
            'note'             => $_POST['note'] ?? '',
            'total_amount'     => $total,
            'payment_method'   => 'cod', 
            'status'           => 'pending' 
        ];

        try {
            $orderRepo = new OrderRepository(); 
            $orderId = $orderRepo->saveOrder($data, $_SESSION['cart']);

            if ($orderId) {
                unset($_SESSION['cart']); 
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Đặt món thành công!', 
                    'order_id' => $orderId
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống khi lưu Database']);
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function history() {
    if (!isset($_SESSION['user'])) {
        header('Location: /web_ban_oc_pro/public/login');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $orderRepo = new \App\Repositories\OrderRepository();
    
    $orders = $orderRepo->getOrdersByUserId($userId);

    include __DIR__ . '/../../views/client/order_history.php';
}

    public function success() {
        include __DIR__ . '/../../views/client/order_success.php';
    }
}