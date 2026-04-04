<?php
namespace App\Repositories;

use App\Core\Database;
use PDO;

class UserRepository {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(); 
    }

   public function create($data) {
    try {
        $sql = "INSERT INTO users (username, phone, address, role, password) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            $data['name'], 
            $data['phone'], 
            $data['address'] ?? null,
            $data['role'] ?? 'customer',
            $data['password']
        ]);
        return $result ? $this->db->lastInsertId() : false;
    } catch (\PDOException $e) {
        // die($e->getMessage()); 
        return false;
    }
}


public function findByPhone($phone) {
    $sql = "SELECT * FROM users WHERE phone = ? LIMIT 1";
    
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$phone]);
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        error_log("Lỗi findByPhone: " . $e->getMessage());
        return false;
    }
}
}