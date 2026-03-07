<?php
namespace App\Repositories;

use App\Core\Database;

abstract class BaseRepository {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function beginTransaction() {
        return $this->db->beginTransaction();
    }

    public function commit() {
        return $this->db->commit();
    }

    public function rollback() {
        return $this->db->rollBack();
    }

    public function all($table) {
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }
}