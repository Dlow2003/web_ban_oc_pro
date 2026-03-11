<?php 
$title = "Chỉnh Sửa Danh Mục - Admin";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-header bg-gradient text-white p-4" style="background: linear-gradient(135deg, #ff7a00, #ff9500); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-2x me-3"></i>
                        <h4 class="mb-0 fw-bold">Chỉnh Sửa Danh Mục</h4>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <form action="/web_ban_oc_pro/public/admin/category/update" method="POST">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold small">TÊN DANH MỤC</label>
                            <input type="text" name="name" class="form-control rounded-3 py-2" 
                                   value="<?= htmlspecialchars($category['name']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">MÔ TẢ</label>
                            <textarea name="description" class="form-control rounded-3" rows="3"><?= htmlspecialchars($category['description']) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">TRẠNG THÁI</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Tạm ẩn</option>
                            </select>
                        </div>

                        <div class="row g-2 pt-3">
                            <div class="col-8">
                                <button type="submit" class="btn btn-warning w-100 fw-bold text-white rounded-3 py-2">
                                    CẬP NHẬT THAY ĐỔI
                                </button>
                            </div>
                            <div class="col-4">
                                <a href="/web_ban_oc_pro/public/admin/category" class="btn btn-outline-secondary w-100 rounded-3 py-2">HỦY</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>