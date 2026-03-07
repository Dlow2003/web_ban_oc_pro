<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Ốc VKU Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --vku-orange: #ff7a00; }
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background: var(--vku-orange);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #eee;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.1);
            border-color: var(--vku-orange);
        }
        .btn-login {
            background: var(--vku-orange);
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
            transition: 0.3s;
            border: none;
        }
        .btn-login:hover {
            background: #e66e00;
            transform: translateY(-2px);
        }
        .back-home {
            color: #666;
            text-decoration: none;
            transition: 0.3s;
        }
        .back-home:hover { color: var(--vku-orange); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card login-card">
                <div class="login-header">
                    <i class="fas fa-utensils fa-3x mb-3"></i>
                    <h3 class="fw-bold mb-0">ỐC VKU PRO</h3>
                    <p class="small mb-0 opacity-75">Chào mừng bạn quay trở lại!</p>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger small py-2"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="/web_ban_oc_pro/public/login" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">EMAIL</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@gmail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">MẬT KHẨU</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login">ĐĂNG NHẬP NGAY</button>
                        </div>
                        <div class="text-center small">
                            <span class="text-muted">Chưa có tài khoản?</span> 
                            <a href="/web_ban_oc_pro/public/register" class="text-orange fw-bold" style="color: var(--vku-orange); text-decoration: none;">Đăng ký</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="/web_ban_oc_pro/public/" class="back-home small">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>