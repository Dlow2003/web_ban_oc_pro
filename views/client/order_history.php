<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="fas fa-history text-orange"></i> LỊCH SỬ ĐẶT MÓN</h3>

    <?php if(empty($orders)): ?>
        <div class="text-center py-5">
            <p class="text-muted">Bạn chưa đặt món nào hết. Đi ăn ốc thôi!</p>
            <a href="/web_ban_oc_pro/public/" class="btn btn-orange rounded-pill text-white">Đặt món ngay</a>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-4">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                        <tr>
                            <td class="ps-4 fw-bold">#<?= $order['id'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td class="text-danger fw-bold"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td>
                                <?php 
                                    $statusClass = [
                                        'pending' => 'bg-warning text-dark',
                                        'confirmed' => 'bg-info text-white',
                                        'shipping' => 'bg-primary text-white',
                                        'complete' => 'bg-success text-white'
                                    ];
                                    $statusText = [
                                        'pending' => 'Chờ duyệt',
                                        'confirmed' => 'Đã xác nhận',
                                        'shipping' => 'Đang giao',
                                        'complete' => 'Hoàn thành'
                                    ];
                                ?>
                                <span class="badge rounded-pill <?= $statusClass[$order['status']] ?? 'bg-secondary' ?>">
                                    <?= $statusText[$order['status']] ?? $order['status'] ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="/web_ban_oc_pro/public/order/detail/<?= $order['id'] ?>" class="btn btn-sm btn-outline-orange rounded-pill">Chi tiết</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>