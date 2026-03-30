<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\OrderRepository;

class AdminOrderController extends BaseController {
    protected $orderRepo;

    public function __construct() {
        $this->orderRepo = new OrderRepository();
    }

    public function index() {
        $orders = $this->orderRepo->getAllOrders();
        require_once __DIR__ . '/../../../views/admin/orders/index.php';
    }

    public function updateStatus() {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;

    if ($id && $status) {
        $this->orderRepo = new \App\Repositories\OrderRepository();
        $result = $this->orderRepo->updateStatus($id, $status);

        if ($result) {
            header('Location: /web_ban_oc_pro/public/admin/orders?msg=updated');
            exit;
        }
    }
    
    header('Location: /web_ban_oc_pro/public/admin/orders?msg=error');
    exit;
}
}
?>