<?php
namespace App\Repositories;

use App\Core\Database;

abstract class BaseRepository {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Quản lý Transaction cho các tác vụ quan trọng (Đặt hàng, Thanh toán)
    public function beginTransaction() {
        return $this->db->beginTransaction();
    }

    public function commit() {
        return $this->db->commit();
    }

    public function rollback() {
        return $this->db->rollBack();
    }

    // Ví dụ một hàm lấy tất cả bản ghi dùng chung
    public function all($table) {
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }
}