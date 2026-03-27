<?php
namespace App\Repositories;

use App\Core\Database;
use PDO;

class OrderRepository {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createOrder($data, $cart) {
    try {
        $this->db->beginTransaction();

        $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, customer_email, shipping_address, note, total_amount, payment_method, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['user_id'], $data['customer_name'], $data['customer_phone'], 
            $data['customer_email'], $data['shipping_address'], $data['note'], 
            $data['total_amount'], $data['payment_method'], $data['status']
        ]);

        $orderId = $this->db->lastInsertId();

        $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmtItem = $this->db->prepare($sqlItem);
        foreach ($cart as $id => $item) {
            $stmtItem->execute([$orderId, $id, $item['quantity'], $item['price']]);
        }

        $this->db->commit();
        return $orderId;
    } catch (\Exception $e) {
        $this->db->rollBack();
        error_log($e->getMessage());
        return false;
    }
}
public function getOrdersByUserId($userId) {
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
   public function saveOrder($data, $cart) {
    try {
        $this->db->beginTransaction();

        $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, customer_email, shipping_address, note, total_amount, payment_method, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['user_id'], $data['customer_name'], $data['customer_phone'], 
            $data['customer_email'], $data['shipping_address'], $data['note'], 
            $data['total_amount'], $data['payment_method'], $data['status']
        ]);

        $orderId = $this->db->lastInsertId();

        $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)";
        $stmtItem = $this->db->prepare($sqlItem);

        foreach ($cart as $id => $item) {
            $stmtItem->execute([
                $orderId, 
                $id, 
                $item['quantity'], 
                $item['price']
            ]);
        }

        $this->db->commit();
        return $orderId;
        } catch (\Exception $e) {
    $this->db->rollBack();
    echo json_encode(['status' => 'error', 'message' => 'Lỗi SQL: ' . $e->getMessage()]);
    exit; 
}
    
}
}