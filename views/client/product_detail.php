<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/client-style.css">

<div class="container mt-5 mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/web_ban_oc_pro/public/" class="text-decoration-none text-orange">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($product['name']) ?></li>
        </ol>
    </nav>

    <div class="row bg-white shadow-sm rounded-4 overflow-hidden p-4">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-img-large rounded-4 overflow-hidden border">
                <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $product['image'] ?>"
                    class="img-fluid w-100" style="object-fit: cover; min-height: 400px;">
            </div>
        </div>

        <div class="col-md-6 ps-md-5 d-flex flex-column">
            <h2 class="fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h2>

            <div class="mb-3">
                <span class="badge bg-success py-2 px-3 rounded-pill">Đang bán</span>
                <span class="text-muted ms-2 small">Mã: SP-<?= $product['id'] ?></span>
            </div>

            <h3 class="text-danger fw-bold mb-4"><?= number_format($product['price'], 0, ',', '.') ?>đ</h3>

            <div class="mb-4">
                <h6 class="fw-bold">Mô tả món ăn:</h6>
                <p class="text-secondary" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($product['description'] ?? 'Món ốc thơm ngon, đậm đà hương vị, được chế biến từ nguyên liệu tươi sống trong ngày.')) ?>
                </p>
            </div>

            <div class="mt-auto row g-2">
                <div class="col-4">
                    <input type="number" id="detail-quantity" value="1" min="1" class="form-control">
                </div>
                <div class="col-8">
                    <button class="btn btn-warning btn-sm w-100 text-white rounded-pill shadow-sm py-2 btn-add-cart"
                        data-id="<?= $product['id'] ?>"
                        data-logged="<?= isset($_SESSION['user']) ? 'true' : 'false' ?>">
                        <i class="fas fa-cart-plus"></i> THÊM VÀO GIỎ HÀNG
                    </button>
                </div>
            </div>

            <div class="mt-4 border-top pt-3 small text-muted">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-truck-moving text-orange me-2"></i> Giao hàng trong 30 phút
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-utensils text-orange me-2"></i> Đảm bảo vệ sinh an toàn thực phẩm
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="fw-bold mb-4">Món ốc khác bạn có thể thích</h4>
        <div class="row g-3">
            <?php foreach ($relatedProducts as $item): ?>
                <div class="col-6 col-md-3">
                    <a href="/web_ban_oc_pro/public/product/detail/<?= $item['id'] ?>" class="text-decoration-none text-dark">
                        <div class="card product-card border-0 shadow-sm h-100">
                            <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $item['image'] ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <p class="fw-bold mb-1 small text-truncate"><?= $item['name'] ?></p>
                                <p class="text-danger small mb-0"><?= number_format($item['price']) ?>đ</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/modal_order.php'; ?>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
