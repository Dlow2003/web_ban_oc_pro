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
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'], 
            $data['email'], 
            $data['password'], 
            $data['role']
        ]);
    }
}