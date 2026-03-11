<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thực đơn Ốc VKU Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/web_ban_oc_pro/public/assets/css/menu-style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: #ff7a00;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">ỐC </a>
        <div class="ms-auto d-flex align-items-center text-white">
            <span class="me-3">Trang chủ</span>
            <span class="me-3">Đơn hàng</span>
            <div class="d-flex align-items-center">
                <i class="fas fa-user-circle fa-2x me-2"></i>
                <div>
                    <div class="small">Chào bạn,</div>
                    <div class="fw-bold"><?= $_SESSION['user']['name'] ?? 'Khách' ?></div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4 px-4">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group shadow-sm sticky-top" style="top: 20px;">
                <div class="list-group-item fw-bold bg-white text-orange border-0">THỰC ĐƠN</div>
                <?php foreach($categories as $cat): ?>
                    <a href="#cat-<?= $cat['id'] ?>" class="list-group-item list-group-item-action border-0 py-3">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-7">
            <div class="input-group mb-4 shadow-sm bg-white rounded-3">
                <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-0 py-3" placeholder="Bạn muốn tìm đồ ăn gì?">
            </div>

            <div class="card border-0 mb-4 rounded-4 shadow-sm overflow-hidden">
                <img src="https://images.unsplash.com/photo-1551024323-a2d8d533d7c9?auto=format&fit=crop&w=1000&q=80" class="card-img" alt="Banner">
            </div>

            <?php foreach($categories as $cat): ?>
            <div class="mb-5" id="cat-<?= $cat['id'] ?>">
                <h4 class="fw-bold mb-4"><?= mb_strtoupper($cat['name']) ?></h4>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3 p-2">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/100" class="rounded-3 me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Ốc Hương Rang Muối</h6>
                                    <div class="text-warning small mb-2">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-orange">85.000 đ</span>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fas fa-minus"></i></button>
                                            <span class="mx-3 fw-bold">0</span>
                                            <button class="btn btn-sm btn-warning rounded-circle text-white"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm sticky-top rounded-4 p-4 text-center" style="top: 20px; min-height: 400px;">
                <div class="mt-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/1162/1162456.png" style="width: 80px; opacity: 0.3;">
                    <p class="text-muted mt-3">Mua sắm thôi nào!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>