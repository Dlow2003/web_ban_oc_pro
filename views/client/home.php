<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="jumbotron shadow p-5 mb-4 bg-white rounded">
            <h1 class="display-4 text-primary"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $slogan; ?></p>
            <hr class="my-4">
            <p>Hệ thống đang chạy trên cấu trúc <strong>MVC + Service + Repository</strong>.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Xem Menu Ốc</a>
        </div>
    </div>
</body>
</html>