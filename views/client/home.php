<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid mt-3 px-2 px-md-4">
    <div class="row g-3">
        <div class="col-md-2 d-none d-md-block">
            <div class="card border-0 shadow-sm sticky-top" style="top: 80px; z-index: 10;">
                <div class="card-body p-0">
                    <div class="p-3 fw-bold border-bottom text-orange">THỰC ĐƠN</div>
                    <div class="list-group list-group-flush">
                        <a href="/web_ban_oc_pro/public/" class="list-group-item list-group-item-action border-0 py-3 <?= empty($currentCategory) ? 'text-orange fw-bold' : '' ?>">
                            Tất cả món
                        </a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="?category=<?= $cat['id'] ?>" class="list-group-item list-group-item-action border-0 py-3 <?= (isset($currentCategory) && $currentCategory == $cat['id']) ? 'text-orange fw-bold' : '' ?>">
                                <i class="fas fa-chevron-right me-2 small"></i> <?= htmlspecialchars($cat['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-7">
            
            <div class="d-block d-md-none mb-3">
                <div class="d-flex overflow-auto flex-nowrap gap-2 pb-2 shadow-scrollbar">
                    <a href="/web_ban_oc_pro/public/" class="btn btn-sm <?= empty($currentCategory) ? 'btn-orange text-white' : 'btn-outline-orange' ?> rounded-pill text-nowrap">Tất cả</a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="?category=<?= $cat['id'] ?>" class="btn btn-sm <?= (isset($currentCategory) && $currentCategory == $cat['id']) ? 'btn-orange text-white' : 'btn-outline-orange' ?> rounded-pill text-nowrap">
                            <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <form action="" method="GET" class="input-group mb-4 shadow-sm bg-white rounded-pill overflow-hidden border">
                <span class="input-group-text bg-white border-0 ps-4"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-0 py-3" placeholder="Hôm nay bạn muốn ăn ốc gì?">
                <button type="submit" class="btn btn-orange px-4 text-white">Tìm</button>
            </form>

            <div class="row g-2 g-md-3" id="product-list">
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $item): ?>
                    <div class="col-6 col-lg-4 mb-3 d-flex align-items-stretch">
                        <div class="card product-card shadow-sm border-0 rounded-4 w-100 overflow-hidden">
                            <div class="product-img-container position-relative">
                                <?php if($item['id'] > 10): ?>
                                    <span class="badge-custom badge-new">Món mới</span>
                                <?php endif; ?>

                                <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $item['image'] ?>" 
                                     class="card-img-top" 
                                     style="height: 160px; object-fit: cover;">
                            </div>
                            
                            <div class="card-body d-flex flex-column p-2 p-md-3">
                                <h6 class="fw-bold product-name mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                <div class="mt-auto">
                                    <p class="text-danger fw-bold mb-2"><?= number_format($item['price'], 0, ',', '.') ?>đ</p>
                                    <button class="btn btn-warning btn-sm w-100 text-white rounded-pill shadow-sm py-2">
                                        <i class="fas fa-shopping-cart"></i> <span class="d-none d-sm-inline">ĐẶT MÓN</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Không tìm thấy món ốc nào phù hợp.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination pagination-sm justify-content-center">
                    <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link rounded-pill px-3" href="?page=<?= $currentPage - 1 ?>&category=<?= $currentCategory ?? '' ?>">Trước</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link rounded-circle mx-1" href="?page=<?= $i ?>&category=<?= $currentCategory ?? '' ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link rounded-pill px-3 ms-2" href="?page=<?= $currentPage + 1 ?>&category=<?= $currentCategory ?? '' ?>">Sau</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
        </div>

        <div class="col-md-3 d-none d-md-block">
            <div class="card border-0 shadow-sm sticky-top rounded-4" style="top: 80px; min-height: 400px;">
                <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                    <h5 class="fw-bold">GIỎ HÀNG CỦA BẠN</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" class="mx-auto mb-3" style="width: 80px; opacity: 0.3;">
                    <p class="small text-secondary">Chưa có món nào được chọn.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="/web_ban_oc_pro/public/cart" class="btn-cart-float d-flex d-md-none shadow-lg">
    <i class="fas fa-shopping-basket"></i>
    <span class="badge rounded-pill bg-danger"><?= count($_SESSION['cart'] ?? []) ?></span>
</a>

<style>
    .btn-orange { background-color: #ff7a00; color: white; }
    .btn-outline-orange { color: #ff7a00; border: 1px solid #ff7a00; }
    .text-orange { color: #ff7a00 !important; }
    
    .product-card { transition: transform 0.2s; }
    .product-card:hover { transform: translateY(-5px); }
    
    .product-name {
        height: 2.4rem;
        line-height: 1.2rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .shadow-scrollbar::-webkit-scrollbar { display: none; }
    .shadow-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .btn-cart-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ff7a00;
        color: white;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        text-decoration: none;
        font-size: 20px;
    }
    .btn-cart-float .badge {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 10px;
    }

    @media (max-width: 576px) {
        .card-img-top { height: 120px !important; }
        .product-name { font-size: 0.85rem !important; }
    }
</style>

<?php include __DIR__ . '/../layouts/footer.php'; ?>