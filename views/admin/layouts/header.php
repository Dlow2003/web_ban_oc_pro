<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Hệ thống Quản trị - Quán Ốc ' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="/web_ban_oc_pro/public/admin/dashboard">Ốc  Admin</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/web_ban_oc_pro/public/admin/category">Danh mục</a>
                <a class="nav-link" href="/web_ban_oc_pro/public/admin/product">Sản phẩm</a>
                <a class="nav-link text-danger" href="/web_ban_oc_pro/public/logout">Đăng xuất</a>
            </div>
        </div>
    </nav>