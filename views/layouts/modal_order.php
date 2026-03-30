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
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="address-group">
                        <label class="small fw-bold">Địa chỉ nhận hàng</label>
                        <textarea name="address" id="cust-address" class="form-control rounded-3" rows="2" placeholder="Số nhà, tên đường..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 rounded-pill py-2 fw-bold mt-2 shadow">XÁC NHẬN ĐẶT MÓN</button>
                </form>
            </div>
        </div>
    </div>
</div>