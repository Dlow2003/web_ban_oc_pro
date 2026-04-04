<?php include __DIR__ . '../../layouts/header.php'; ?>

<div class="container-fluid admin-container">
    <div class="admin-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">DANH SÁCH ĐƠN HÀNG</h5>
            <span class="text-muted small">Cập nhật: <?= date('d/m/Y H:i') ?></span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Liên hệ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="fw-bold text-primary">#<?= $order['id'] ?></td>
                            <td>
                                <div><?= htmlspecialchars($order['customer_name'] ?? 'Khách lẻ') ?></div>
                                <small class="text-muted">Bàn: <?= $order['table_number'] ?? 'Mang về' ?></small>
                            </td>
                            <td><i class="fas fa-phone-alt small me-1"></i> <?= $order['phone'] ?></td>
                            <td class="fw-bold"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td>
                                <span class="status-badge status-<?= $order['status'] ?>">
                                    <?= strtoupper($order['status']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="/web_ban_oc_pro/public/admin/orders/update" method="POST">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <select name="status" class="status-select">
                                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ duyệt</option>
                                        <option value="confirmed" <?= $order['status'] == 'confirmed' ? 'selected' : '' ?>>Xác nhận</option>
                                        <option value="shipping" <?= $order['status'] == 'shipping' ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Hủy bỏ</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/admin-orders.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/web_ban_oc_pro/public/assets/js/admin-orders.js"></script>