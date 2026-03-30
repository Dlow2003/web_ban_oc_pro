<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/client-style.css">

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

            <form action="/web_ban_oc_pro/public/" method="GET" class="input-group mb-4 shadow-sm bg-white rounded-pill border position-relative" style="overflow: visible;">
                <span class="input-group-text bg-white border-0 ps-4"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-0 py-3"
                    placeholder="Hôm nay bạn muốn ăn gì?"
                    autocomplete="off"
                    value="<?= htmlspecialchars($keyword ?? '') ?>">

                <?php if (!empty($currentCategory)): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($currentCategory) ?>">
                <?php endif; ?>

                <button type="submit" class="btn btn-orange px-4 text-white">Tìm</button>
                <div id="search-results" class="search-results-ajax shadow-lg"></div>
            </form>

            <?php if (!empty($keyword)): ?>
                <p class="mb-4">Kết quả cho: <strong class="text-orange">"<?= htmlspecialchars($keyword) ?>"</strong></p>
            <?php endif; ?>

            <div class="row g-2 g-md-3" id="product-list">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $item): ?>
                        <div class="col-6 col-lg-4 mb-3 d-flex align-items-stretch">
                            <div class="card product-card shadow-sm border-0 rounded-4 w-100 overflow-hidden">
                                <a href="/web_ban_oc_pro/public/product/detail/<?= $item['id'] ?>" class="text-decoration-none text-dark">
                                    <div class="product-img-container position-relative">
                                        <?php if (isset($item['id']) && $item['id'] > 10): ?>
                                            <span class="badge-custom badge-new" style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-size: 10px; z-index: 1;">Mới</span>
                                        <?php endif; ?>
                                        <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= htmlspecialchars($item['image']) ?>"
                                            class="card-img-top"
                                            style="height: 160px; object-fit: cover;"
                                            alt="<?= htmlspecialchars($item['name']) ?>">
                                    </div>

                                    <div class="card-body p-2 p-md-3 pb-0">
                                        <h6 class="fw-bold product-name mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                    </div>
                                </a>

                                <div class="card-body d-flex flex-column p-2 p-md-3 pt-0">
                                    <div class="mt-auto">
                                        <p class="text-danger fw-bold mb-2"><?= number_format($item['price'], 0, ',', '.') ?>đ</p>
                                        <button class="btn btn-warning btn-sm w-100 text-white rounded-pill shadow-sm py-2 btn-add-cart"
                                            data-id="<?= $item['id'] ?>"
                                            data-logged="<?= isset($_SESSION['user']) ? 'true' : 'false' ?>">
                                            <i class="fas fa-shopping-cart"></i> ĐẶT MÓN
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/5058/5058432.png" style="width: 80px; opacity: 0.2;" class="mb-3" alt="No products">
                        <p class="text-muted">Không tìm thấy món ốc nào phù hợp.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (isset($totalPages) && $totalPages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination pagination-sm justify-content-center">
                        <?php 
                            $queryStr = "&category=" . ($currentCategory ?? '') . "&search=" . urlencode($keyword ?? '');
                        ?>
                        <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link rounded-pill px-3" href="?page=<?= $currentPage - 1 . $queryStr ?>">Trước</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a class="page-link rounded-circle mx-1" href="?page=<?= $i . $queryStr ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link rounded-pill px-3 ms-2" href="?page=<?= $currentPage + 1 . $queryStr ?>">Sau</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

        <div class="col-md-3 d-none d-md-block">
            <div class="card border-0 shadow-sm sticky-top rounded-4" style="top: 80px; min-height: 400px;">
                <div class="card-header bg-white border-0 pt-4 pb-2 text-center">
                    <h5 class="fw-bold">GIỎ HÀNG CỦA BẠN</h5>
                   <?php if (isset($_SESSION['user'])): ?>
    <div class="small text-muted">
        <i class="fas fa-map-marker-alt text-orange"></i>
        <?php 
            $userType = $_SESSION['user']['type'] ?? 'at_store'; 
            $userTable = $_SESSION['user']['table'] ?? '...';

            if ($userType == 'at_store') {
                echo 'Bàn: ' . (!empty($userTable) ? $userTable : '...');
            } else {
                echo 'Ship tận nơi';
            }
        ?>
    </div>
<?php endif; ?>
                </div>

                <div class="card-body p-2 overflow-auto" style="max-height: 450px;">
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <div class="list-group list-group-flush">
                            <?php
                            $totalOrder = 0;
                            foreach ($_SESSION['cart'] as $id => $cartItem):
                                $subTotal = $cartItem['price'] * $cartItem['quantity'];
                                $totalOrder += $subTotal;
                            ?>
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= htmlspecialchars($cartItem['image']) ?>"
                                            class="rounded-3 me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 120px;"><?= htmlspecialchars($cartItem['name']) ?></h6>
                                            <div class="small text-danger"><?= number_format($cartItem['price'], 0, ',', '.') ?>đ x <?= $cartItem['quantity'] ?></div>
                                        </div>
                                        <div class="fw-bold small"><?= number_format($subTotal, 0, ',', '.') ?>đ</div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" class="mx-auto mb-3" style="width: 60px; opacity: 0.3;">
                            <p class="small text-secondary">Chưa có món nào được chọn.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($_SESSION['cart'])): ?>
                    <div class="card-footer bg-white border-0 pt-0 pb-4">
                        <hr>
                        <div class="d-flex justify-content-between mb-3 px-2">
                            <span class="fw-bold">Tổng cộng:</span>
                            <span class="text-danger fw-bold fs-5"><?= number_format($totalOrder, 0, ',', '.') ?>đ</span>
                        </div>
                        <a href="/web_ban_oc_pro/public/cart" class="btn btn-orange w-100 rounded-pill fw-bold py-2 shadow-sm">
                            XEM GIỎ HÀNG
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<a href="/web_ban_oc_pro/public/cart" class="btn-cart-float d-flex d-md-none shadow-lg text-decoration-none">
    <i class="fas fa-shopping-basket"></i>
    <span class="badge rounded-pill bg-danger"><?= count($_SESSION['cart'] ?? []) ?></span>
</a>

<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Thông tin đặt món</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-confirm-order">
                    <input type="hidden" name="id" id="modal-product-id">

                    <div class="mb-3">
                        <label class="small fw-bold">Họ tên của bạn</label>
                        <input type="text" name="name" id="cust-name" class="form-control rounded-pill" placeholder="VD: Nguyễn Văn A" required>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold">Số điện thoại</label>
                        <input type="tel" name="phone" id="cust-phone" class="form-control rounded-pill" placeholder="0905xxxxxx" required>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold">Hình thức nhận món</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderType" id="typeAtStore" value="at_store" checked>
                                <label class="form-check-label fw-bold" for="typeAtStore">Tại quán</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderType" id="typeShip" value="ship">
                                <label class="form-check-label fw-bold" for="typeShip">Giao tận nơi</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="table-group">
                        <label class="small fw-bold">Chọn số bàn</label>
                        <select name="table_number" id="table-number" class="form-select rounded-pill">
                            <option value="">-- Chọn bàn --</option>
                            <?php for ($i = 1; $i <= 20; $i++): ?>
                                <option value="<?= $i ?>">Bàn số <?= $i ?></option>
                            <?php endfor; ?>
                            <option value="mang_ve">Mang về (Chờ tại quầy)</option>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="address-group">
                        <label class="small fw-bold">Địa chỉ nhận hàng</label>
                        <textarea name="address" id="cust-address" class="form-control rounded-3" rows="2" placeholder="Số nhà, tên đường, phường/xã..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 rounded-pill py-2 fw-bold mt-2 shadow">XÁC NHẬN ĐẶT MÓN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/web_ban_oc_pro/public/assets/js/search.js"></script>
<?php include __DIR__ . '/../layouts/footer.php'; ?>