<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - Ốc VKU Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --vku-orange: #ff7a00; }
        body {
            background: #f4f7f6;
            font-family: 'Lexend', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #ff7a00, #ff9500);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #eee;
            transition: 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1);
            border-color: var(--vku-orange);
        }
        .btn-register {
            background: var(--vku-orange);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-register:hover {
            background: #e66e00;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 122, 0, 0.3);
        }
        .login-link {
            color: var(--vku-orange);
            text-decoration: none;
            font-weight: 700;
        }
        .login-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card register-card">
                <div class="register-header">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h3 class="fw-bold mb-1">THÀNH VIÊN MỚI</h3>
                    <p class="small mb-0 opacity-75">Bắt đầu trải nghiệm ẩm thực tại VKU</p>
                </div>
                <div class="card-body p-4 p-lg-5">
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-3 py-2">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span class="small"><?= $error ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="/web_ban_oc_pro/public/register" method="POST">
                        <div class="mb-3">
                            <label class="form-label">HỌ VÀ TÊN</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control border-start-0" placeholder="Nguyễn Văn A" required style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">EMAIL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" placeholder="vku@example.com" required style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">MẬT KHẨU</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-register">Đăng ký ngay</button>
                        </div>

                        <div class="text-center small">
                            <span class="text-muted">Đã có tài khoản?</span> 
                            <a href="/web_ban_oc_pro/public/login" class="login-link ms-1">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="/web_ban_oc_pro/public/" class="text-secondary text-decoration-none small">
                    <i class="fas fa-chevron-left me-1"></i> Trở về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>