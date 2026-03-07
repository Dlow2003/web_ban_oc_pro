<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điều khiển - Quán Ốc </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Hệ thống quản lý Quán Ốc</span>
            <a href="/web_ban_oc_pro/public/logout" class="btn btn-outline-danger">Đăng xuất</a>
        </div>
    </nav>

    <div class="container">
        <h1>Chào mừng, <?php echo $user_name; ?>!</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục ốc</h5>
                        <p class="card-text">Hiện có <?php echo $total_categories; ?> loại ốc.</p>
<a href="/web_ban_oc_pro/public/admin/category/add" class="btn btn-light">Quản lý ngay</a>                    </div>
                </div>
            </div>
            </div>
    </div>
</body>
</html>