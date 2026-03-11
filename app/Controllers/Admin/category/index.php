<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý danh mục ốc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary"><i class="fas fa-list"></i> Danh Mục Các Loại Ốc</h2>
            <a href="/web_ban_oc_pro/public/admin/category/add" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm loại mới
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên loại</th>
                            <th>Slug (URL)</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?php echo $cat['id']; ?></td>
                            <td><strong><?php echo $cat['name']; ?></strong></td>
                            <td><code><?php echo $cat['slug']; ?></code></td>
                            <td>
                                <?php if ($cat['status'] == 1): ?>
                                    <span class="badge bg-success">Hiển thị</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Ẩn</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/web_ban_oc_pro/public/admin/category/edit/<?php echo $cat['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?php echo $cat['id']; ?>)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Bạn có chắc chắn muốn xóa loại ốc này không?')) {
                window.location.href = '/web_ban_oc_pro/public/admin/category/delete/' + id;
            }
        }
    </script>
</body>
</html>