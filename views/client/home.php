<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid mt-3 px-4">
    <div class="row">
        <div class="col-md-2 d-none d-md-block">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body p-0">
                    <div class="p-3 fw-bold border-bottom text-orange">DANH MỤC</div>
                    <div class="list-group list-group-flush">
                        <?php foreach($categories as $cat): ?>
                            <a href="#cat-<?= $cat['id'] ?>" class="list-group-item list-group-item-action border-0 py-3">
                                <i class="fas fa-chevron-right me-2 small"></i> <?= htmlspecialchars($cat['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="input-group mb-4 shadow-sm bg-white rounded-pill overflow-hidden border">
                <span class="input-group-text bg-white border-0 ps-4"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-0 py-3" placeholder="Hôm nay bạn muốn ăn ốc gì?">
            </div>

            <?php foreach($categories as $cat): ?>
            <div id="cat-<?= $cat['id'] ?>" class="mb-5">
                <h4 class="fw-bold text-dark mb-4 border-start border-4 border-warning ps-3">
                    <?= mb_strtoupper($cat['name']) ?>
                </h4>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 p-3 item-food">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-4 me-3 d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="fas fa-utensils fa-2x text-secondary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">Món ốc mẫu từ <?= $cat['name'] ?></h5>
                                    <div class="text-warning mb-2 small">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-5 fw-bold text-orange">65.000đ</span>
                                        <button class="btn btn-warning rounded-pill px-4 text-white fw-bold">
                                            <i class="fas fa-plus me-1"></i> Thêm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm sticky-top rounded-4" style="top: 20px; min-height: 500px;">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" class="mx-auto mb-3" style="width: 100px; opacity: 0.2;">
                    <h5 class="text-muted">Giỏ hàng trống</h5>
                    <p class="small text-secondary">Chọn món ốc bạn thích để bắt đầu đặt hàng nhé!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>