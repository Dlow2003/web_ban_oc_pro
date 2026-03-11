<?php
namespace App\Repositories;

class CategoryRepository extends BaseRepository {
    protected $table = 'categories';

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll();
    }
    public function countAll() {
    $sql = "SELECT COUNT(*) as total FROM categories";
    $stmt = $this->db->query($sql);
    return $stmt->fetch()['total'];
}

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, slug, description, status) VALUES (?, ?, ?, ?)";
        return $this->db->prepare($sql)->execute([
            $data['name'], $data['slug'], $data['description'], $data['status']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET name = ?, slug = ?, description = ?, status = ? WHERE id = ?";
        return $this->db->prepare($sql)->execute([
            $data['name'], $data['slug'], $data['description'], $data['status'], $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function existsBySlug($slug) {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetchColumn() > 0;
}
}