<?php $title = "Thêm Món Ăn Mới"; include __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-orange text-white p-4">
            <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Thêm Món Mới</h4>
        </div>
        <div class="card-body p-4">
            <form action="/web_ban_oc_pro/public/admin/product/store" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tên món ăn</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="VD: Ốc Hương Sốt Trứng Muối" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category_id" class="form-select rounded-3">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <input type="number" name="price" class="form-control rounded-3" placeholder="VD: 85000" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Hình ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control rounded-3">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Mô tả món ăn</label>
                        <textarea name="description" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-warning text-white fw-bold px-5 py-2 rounded-3">LƯU MÓN ĂN</button>
                    <a href="/web_ban_oc_pro/public/admin/product" class="btn btn-light px-4 py-2 rounded-3">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>