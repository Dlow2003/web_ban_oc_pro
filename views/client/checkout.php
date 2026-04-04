<div class="container mt-5">
    <h2 class="mb-4">Xác nhận thanh toán</h2>
    <form action="/web_ban_oc_pro/public/order/checkout" method="POST">
        <div class="row">
            <div class="col-md-7">
                <div class="card p-3 shadow-sm">
                    <h5>Thông tin nhận món</h5>
                    <p><strong>Người đặt:</strong> <?= $_SESSION['user']['name'] ?> (<?= $_SESSION['user']['phone'] ?>)</p>
                    
                    <div class="mb-3">
                        <label>Hình thức:</label>
                        <select name="order_type" class="form-select" id="orderType">
                            <option value="at_store">Ăn tại quán</option>
                            <option value="takeaway">Mang về</option>
                        </select>
                    </div>

                    <div id="tableInput" class="mb-3">
                        <label>Số bàn:</label>
                        <input type="text" name="table_number" class="form-control" placeholder="Ví dụ: Bàn số 5">
                    </div>

                    <div class="mb-3">
                        <label>Ghi chú đơn hàng:</label>
                        <textarea name="note" class="form-control" rows="2" placeholder="Ít cay, thêm tắc..."></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card p-3 shadow-sm bg-light">
                    <h5>Đơn hàng của bạn</h5>
                    <hr>
                    <?php $total = 0; foreach($_SESSION['cart'] as $item): 
                        $total += $item['price'] * $item['quantity']; ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?= $item['name'] ?> x <?= $item['quantity'] ?></span>
                            <span><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold text-danger fs-5">
                        <span>TỔNG CỘNG:</span>
                        <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-4 py-3 fw-bold">XÁC NHẬN ĐẶT MÓN</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('orderType').addEventListener('change', function() {
        document.getElementById('tableInput').style.display = (this.value === 'at_store') ? 'block' : 'none';
    });
</script>