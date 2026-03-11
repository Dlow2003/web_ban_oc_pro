<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class ProductRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countAll() {
    $sql = "SELECT COUNT(*) as total FROM products";
    $stmt = $this->db->query($sql);
    return $stmt->fetch()['total'];
}
public function getByPage($page, $perPage, $categoryId = null) {
    $offset = ($page - 1) * $perPage;
    
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.status = 1";
    
    if ($categoryId) {
        $sql .= " AND p.category_id = :cat_id";
    }
    
    $sql .= " ORDER BY p.id DESC LIMIT :limit OFFSET :offset";
    
    $stmt = $this->db->prepare($sql);
    
    if ($categoryId) {
        $stmt->bindValue(':cat_id', (int)$categoryId, \PDO::PARAM_INT);
    }
    $stmt->bindValue(':limit', (int)$perPage, \PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
    
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function countByStatus($status = 1, $categoryId = null) {
    $sql = "SELECT COUNT(*) as total FROM products WHERE status = ?";
    $params = [$status];

    if ($categoryId) {
        $sql .= " AND category_id = ?";
        $params[] = $categoryId;
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $result['total'] ?? 0;
}
public function getByPageAdmin($page, $perPage) {
    $offset = ($page - 1) * $perPage;
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.id DESC 
            LIMIT ? OFFSET ?";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(1, (int)$perPage, \PDO::PARAM_INT);
    $stmt->bindValue(2, (int)$offset, \PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function getActiveProducts($categoryId = null) {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.status = 1";
    
    if ($categoryId) {
        $sql .= " AND p.category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
    } else {
        $sql .= " ORDER BY p.id DESC";
        $stmt = $this->db->query($sql);
    }
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

    public function findById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO products (category_id, name, slug, price, image, description, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['category_id'],
            $data['name'],
            $data['slug'],
            $data['price'],
            $data['image'],
            $data['description'],
            $data['status']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE products SET 
                category_id = ?, 
                name = ?, 
                slug = ?, 
                price = ?, 
                image = ?, 
                description = ?, 
                status = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['category_id'],
            $data['name'],
            $data['slug'],
            $data['price'],
            $data['image'],
            $data['description'],
            $data['status'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}