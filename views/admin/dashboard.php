<?php
$title = "Bảng điều khiển - Admin Quán Ốc";
include __DIR__ . '/layouts/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-white shadow-sm min-vh-100 p-0 d-none d-md-block">
            <div class="p-4 text-center border-bottom">
                <img src="https://cdn-icons-png.flaticon.com/512/3081/3081884.png" width="50" class="mb-2">
                <h6 class="fw-bold text-orange">ADMIN ỐC</h6>
            </div>
            <div class="list-group list-group-flush mt-3">
                <a href="#" class="list-group-item list-group-item-action active border-0 py-3">
                    <i class="fas fa-tachometer-alt me-2"></i> Tổng quan
                </a>
                <a href="/web_ban_oc_pro/public/admin/category" class="list-group-item list-group-item-action border-0 py-3">
                    <i class="fas fa-list me-2"></i> Danh mục
                </a>
                <a href="/web_ban_oc_pro/public/admin/product" class="list-group-item list-group-item-action border-0 py-3">
                    <i class="fas fa-fish me-2"></i> Quản lý món ăn
                </a>
                <a href="#" class="list-group-item list-group-item-action border-0 py-3">
                    <i class="fas fa-shopping-cart me-2"></i> Đơn hàng
                </a>
                <a href="/web_ban_oc_pro/public/logout" class="list-group-item list-group-item-action border-0 py-3 text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                </a>
            </div>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Chào mừng quay lại, <span class="text-orange"><?php echo $user_name; ?></span>!</h2>
                <div class="text-muted small"><?php echo date('d/m/Y'); ?></div>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 border-start border-4 border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1 small uppercase fw-bold">DANH MỤC</h6>
                                    <h2 class="fw-bold mb-0"><?php echo $total_categories ?? 0; ?></h2>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-th-list text-primary fa-2x"></i>
                                </div>
                            </div>
                            <a href="/web_ban_oc_pro/public/admin/category" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 border-start border-4 border-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1 small uppercase fw-bold">SẢN PHẨM</h6>
                                    <h2 class="fw-bold mb-0"><?php echo $total_products ?? 0; ?></h2>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-utensils text-success fa-2x"></i>
                                </div>
                            </div>
                            <a href="/web_ban_oc_pro/public/admin/product" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 border-start border-4 border-warning">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1 small uppercase fw-bold">ĐƠN HÀNG</h6>
                                    <h2 class="fw-bold mb-0">156</h2>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-shopping-basket text-warning fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 border-start border-4 border-danger">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1 small uppercase fw-bold">DOANH THU</h6>
                                    <h3 class="fw-bold mb-0">8.5M</h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-money-bill-wave text-danger fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-5">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Hoạt động gần đây</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Thời gian</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10:30</td>
                                <td>Nguyễn Văn A vừa đặt 1 đĩa Ốc Hương Cào</td>
                                <td><span class="badge bg-success rounded-pill">Đã xử lý</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --vku-orange: #ff7a00;
    }

    .text-orange {
        color: var(--vku-orange);
    }

    .bg-orange {
        background-color: var(--vku-orange);
    }

    .list-group-item.active {
        background-color: var(--vku-orange) !important;
    }

    .card {
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>

<?php include __DIR__ . '/layouts/footer.php'; ?>