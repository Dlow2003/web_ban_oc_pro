<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Danh Mục Ốc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 600px;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thêm Loại Ốc Mới</h4>
            </div>
            <div class="card-body">
                <div class="card-body">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="/web_ban_oc_pro/public/admin/category/store" method="POST">
        </form>
</div>
                <form action="/web_ban_oc_pro/public/admin/category/store" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Tên loại ốc (VD: Ốc Xào, Ốc Luộc)</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên loại ốc..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Mô tả đặc điểm loại này..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái hiển thị</label>
                        <select name="status" class="form-select">
                            <option value="1">Hiển thị ngay</option>
                            <option value="0">Tạm ẩn</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                        <a href="/web_ban_oc_pro/public/admin/dashboard" class="btn btn-outline-secondary">Quay lại Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>