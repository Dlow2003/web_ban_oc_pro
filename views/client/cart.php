<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="fas fa-shopping-basket text-orange"></i> GIỎ HÀNG CỦA BẠN</h3>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0">Món ăn</th>
                                    <th class="py-3 border-0">Giá</th>
                                    <th class="py-3 border-0 text-center">Số lượng</th>
                                    <th class="py-3 border-0">Thành tiền</th>
                                    <th class="py-3 border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($cart)): foreach($cart as $id => $item): ?>
                                <tr id="cart-item-<?= $id ?>">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $item['image'] ?>" 
                                                 class="rounded-3 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            <span class="fw-bold text-dark"><?= $item['name'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                    <td>
                                        <div class="input-group input-group-sm justify-content-center" style="width: 100px; margin: 0 auto;">
                                            <button class="btn btn-outline-secondary btn-update-qty" data-id="<?= $id ?>" data-type="minus">-</button>
                                            <input type="text" class="form-control text-center bg-white qty-input" value="<?= $item['quantity'] ?>" readonly>
                                            <button class="btn btn-outline-secondary btn-update-qty" data-id="<?= $id ?>" data-type="plus">+</button>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-orange item-total"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-link text-muted p-0 btn-remove-item" data-id="<?= $id ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Giỏ hàng trống. <a href="/web_ban_oc_pro/public/" class="text-orange">Tiếp tục đặt món!</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">TÓM TẮT ĐƠN HÀNG</h5>
            
            <div class="mb-3">
                <label class="small fw-bold mb-1">Địa chỉ giao hàng</label>
                <input type="text" id="shipping_address" class="form-control rounded-3" 
                       placeholder="Số bàn hoặc địa chỉ cụ thể..." 
                       value="<?= $_SESSION['user']['address'] ?? '' ?>">
            </div>

            <div class="mb-4">
                <label class="small fw-bold mb-1">Ghi chú đơn hàng</label>
                <textarea id="order_note" class="form-control rounded-3" rows="2" 
                          placeholder="Ví dụ: Ăn tại quán, ít cay..."></textarea>
            </div>

            <div class="d-flex justify-content-between mb-2 text-secondary">
                <span>Tạm tính:</span>
                <span id="cart-subtotal"><?= number_format($total, 0, ',', '.') ?>đ</span>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span class="fw-bold text-dark">Tổng cộng:</span>
                <span class="fw-bold text-danger fs-4" id="cart-total-price"><?= number_format($total, 0, ',', '.') ?>đ</span>
            </div>
            
            <button type="button" id="btn-checkout" class="btn btn-orange w-100 rounded-pill py-3 fw-bold text-white mb-3">
                GỬI ĐƠN HÀNG NGAY
            </button>
            <a href="/web_ban_oc_pro/public/" class="btn btn-outline-orange w-100 rounded-pill py-2 small">
                Tiếp tục đặt món
            </a>
        </div>
    </div>
</div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>