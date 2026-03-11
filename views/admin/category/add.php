<?php 
$title = "Thêm Danh Mục Mới - Admin";
include __DIR__ . '/../layouts/header.php'; 
?>

<style>
    :root { --vku-orange: #ff7a00; }
    body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
    .card-add { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .card-header-orange { background: linear-gradient(135deg, #ff7a00, #ff9500); color: white; border-radius: 20px 20px 0 0 !important; padding: 25px; border: none; }
    .form-label { font-weight: 600; color: #444; font-size: 0.9rem; }
    .form-control, .form-select { border-radius: 12px; padding: 12px; border: 2px solid #eee; transition: 0.3s; }
    .form-control:focus, .form-select:focus { border-color: var(--vku-orange); box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.1); }
    .btn-save { background-color: var(--vku-orange); color: white; border: none; border-radius: 12px; padding: 12px; font-weight: bold; transition: 0.3s; }
    .btn-save:hover { background-color: #e66e00; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 122, 0, 0.3); color: white; }
    .btn-back { border-radius: 12px; padding: 12px; }
    .category-icon { background: #fff5eb; color: var(--vku-orange); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card card-add">
                <div class="card-header card-header-orange">
                    <div class="d-flex align-items-center">
                        <div class="category-icon me-3 shadow-sm">
                            <i class="fas fa-layer-group fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">Thêm Danh Mục Mới</h4>
                            <p class="small mb-0 opacity-75">Quản lý các nhóm món ăn, đồ uống trong hệ thống</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-3">
                            <i class="fas fa-exclamation-triangle me-2"></i> 
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="/web_ban_oc_pro/public/admin/category/store" method="POST">
                        <div class="mb-4">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" 
                                   placeholder="Ví dụ: Hải Sản Tươi, Đồ Uống, Món Khai Vị..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phân loại tổng quát</label>
                            <select name="type" class="form-select">
                                <option value="food">Món ăn (Ốc, Hải sản,...) </option>
                                <option value="drink">Đồ uống (Bia, Nước ngọt,...)</option>
                                <option value="side">Món ăn kèm</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mô tả danh mục</label>
                            <textarea name="description" class="form-control" rows="3" 
                                      placeholder="Mô tả ngắn gọn để khách hàng dễ hình dung..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Trạng thái hoạt động</label>
                            <div class="d-flex gap-3">
                                <div class="form-check card p-2 px-3 border-2 w-100 shadow-sm rounded-3">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                                    <label class="form-check-label fw-bold text-success" for="status1">
                                        <i class="fas fa-eye me-1"></i> Hiển thị
                                    </label>
                                </div>
                                <div class="form-check card p-2 px-3 border-2 w-100 shadow-sm rounded-3">
                                    <input class="form-check-input" type="radio" name="status" id="status0" value="0">
                                    <label class="form-check-label fw-bold text-muted" for="status0">
                                        <i class="fas fa-eye-slash me-1"></i> Tạm ẩn
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="row g-2">
                            <div class="col-8">
                                <button type="submit" class="btn btn-save w-100">
                                    <i class="fas fa-plus-circle me-2"></i> THÊM DANH MỤC
                                </button>
                            </div>
                            <div class="col-4">
                                <a href="/web_ban_oc_pro/public/admin/category" class="btn btn-outline-secondary w-100 btn-back">
                                    HỦY
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="text-center mt-4 text-muted small">
                Hệ thống Quản lý Menu VKU Pro
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>