<?php $title = "Sửa món ăn"; include __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-warning text-white p-3">
            <h5 class="mb-0 fw-bold">CHỈNH SỬA MÓN ĂN</h5>
        </div>
        <div class="card-body p-4">
            <form action="/web_ban_oc_pro/public/admin/product/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên món ăn</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select name="category_id" class="form-select">
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                            <?= $cat['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá bán</label>
                                <input type="number" name="price" class="form-control" value="<?= (int)$product['price'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <label class="form-label fw-bold">Hình ảnh hiện tại</label>
                        <div class="mb-3">
                            <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $product['image'] ?>" 
                                 class="img-thumbnail rounded-3 shadow-sm mb-2" id="img-preview" style="max-height: 200px;">
                            <input type="file" name="image" class="form-control" onchange="previewImage(this)">
                            <small class="text-muted">Chọn ảnh mới nếu muốn thay đổi</small>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Tạm ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3">
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold">CẬP NHẬT</button>
                    <a href="/web_ban_oc_pro/public/admin/product" class="btn btn-light px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>