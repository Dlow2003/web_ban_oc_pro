<?php
$title = "Quản lý món ăn - Admin VKU Pro";
include __DIR__ . '/../layouts/header.php';
?>

<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Danh sách món ăn</h2>
            <p class="text-muted small mb-0">Quản lý thực đơn hiện có trên hệ thống</p>
        </div>
        <a href="/web_ban_oc_pro/public/admin/product/add" class="btn btn-warning text-white fw-bold rounded-pill px-4">
            <i class="fas fa-plus-circle me-2"></i> THÊM MÓN MỚI
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">HÌNH ẢNH</th>
                            <th class="py-3 text-secondary small fw-bold">TÊN MÓN</th>
                            <th class="py-3 text-secondary small fw-bold">DANH MỤC</th>
                            <th class="py-3 text-secondary small fw-bold">GIÁ BÁN</th>
                            <th class="py-3 text-secondary small fw-bold text-center">TRẠNG THÁI</th>
                            <th class="py-3 text-secondary small fw-bold text-end pe-4">THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="ps-4">
                                        <?php if ($product['image']): ?>
                                            <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $product['image'] ?>"
                                                class="rounded-3 shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                                <i class="fas fa-image fa-lg"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($product['name']) ?></div>
                                        <div class="text-muted small text-truncate" style="max-width: 200px;">
                                            <?= htmlspecialchars($product['description'] ?? 'Chưa có mô tả') ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill small">
                                            <?= htmlspecialchars($product['category_name']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-orange">
                                            <?= number_format($product['price'], 0, ',', '.') ?>đ
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($product['status'] == 1): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Đang bán</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">Tạm ẩn</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm rounded-3">
                                            <a href="/web_ban_oc_pro/public/admin/product/edit/<?= $product['id'] ?>"
                                                class="btn btn-white btn-sm border-end" title="Sửa">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <a href="/web_ban_oc_pro/public/admin/product/delete/<?= $product['id'] ?>"
                                                class="btn btn-white btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa món này không?')" title="Xóa">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                    <p>Chưa có món ăn nào trong thực đơn.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted small">
        Hiển thị trang <?= $currentPage ?> / <?= $totalPages ?>
    </div>
    <nav>
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Trước</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Sau</a>
            </li>
        </ul>
    </nav>
</div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-orange {
        background-color: #ff7a00;
    }

    .text-orange {
        color: #ff7a00;
    }

    .table-hover tbody tr:hover {
        background-color: #fffaf5;
        transition: 0.2s;
    }

    .btn-white {
        background-color: #fff;
        border: 1px solid #eee;
    }

    .btn-white:hover {
        background-color: #f8f9fa;
    }
</style>

<?php include __DIR__ . '/../layouts/footer.php'; ?>