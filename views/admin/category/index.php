<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục ốc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Quản lý các loại</h2>
            <a href="/web_ban_oc_pro/public/admin/category/add" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm loại  mới
            </a>
        </div>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'added'): ?>
            <div class="alert alert-success">Đã thêm loại  mới thành công!</div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên loại</th>
                            <th>Đường dẫn (Slug)</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td><?= $cat['id'] ?></td>
                                <td><strong><?= $cat['name'] ?></strong></td>
                                <td><code><?= $cat['slug'] ?></code></td>
                                <td>
                                    <?= $cat['status'] == 1 ? '<span class="badge bg-success">Hiển thị</span>' : '<span class="badge bg-secondary">Ẩn</span>' ?>
                                </td>
                                <td>
                                    <a href="/web_ban_oc_pro/public/admin/category/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                    <a href="/web_ban_oc_pro/public/admin/category/delete/<?= $cat['id'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Bạn có chắc muốn xóa loại ốc này?')">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center">Chưa có loại  nào được thêm.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <p class="mt-3"><a href="/web_ban_oc_pro/public/admin/dashboard">← Quay lại Dashboard</a></p>
    </div>
</body>
</html>