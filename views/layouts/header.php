<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Ốc VKU Pro' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/client-style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-2 sticky-top" style="background-color: #ff7a00;">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/web_ban_oc_pro/public/">
            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081884.png" width="40" class="me-2" style="filter: brightness(0) invert(1);">
            ỐC VKU PRO
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-white fw-bold me-3" href="/web_ban_oc_pro/public/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link text-white fw-bold me-3" href="#">Bạn cần hỗ trợ?</a></li>
                <li class="nav-item"><a class="nav-link text-white fw-bold me-4" href="#">Đơn hàng</a></li>
                
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-2x me-2"></i>
                            <div class="text-start">
                                <div style="font-size: 10px; line-height: 1;">Chào bạn,</div>
                                <div class="fw-bold" style="font-size: 14px;"><?= htmlspecialchars($_SESSION['user']['name']) ?></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <?php if($_SESSION['user']['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="/web_ban_oc_pro/public/admin/dashboard"><i class="fas fa-user-shield me-2"></i>Quản trị</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item text-danger" href="/web_ban_oc_pro/public/logout"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="/web_ban_oc_pro/public/login" class="btn btn-outline-light rounded-pill px-4 fw-bold">Đăng nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>