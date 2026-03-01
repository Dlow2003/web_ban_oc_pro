<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        // Dữ liệu giả lập để truyền sang View (sau này sẽ lấy từ Repository)
        $data = [
            'title' => 'Chào mừng đến với Quán Ốc VKU Pro',
            'slogan' => 'Hải sản tươi sống - Công nghệ dẫn đầu'
        ];

        // Gọi View và truyền dữ liệu
        $this->render('client/home', $data);
    }

    // Hàm render hỗ trợ nạp View (Tạm thời viết ở đây, sau này sẽ đưa vào BaseController)
    protected function render($view, $data = []) {
        extract($data); // Biến ['title' => '...'] thành biến $title
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view không tồn tại!");
        }
    }
}