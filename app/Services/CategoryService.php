<?php
namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Helpers\StringHelper; 

class CategoryService {
    private $repository;

    public function __construct() {
        $this->repository = new CategoryRepository();
    }

    public function storeCategory($data) {
    $slug = \App\Helpers\StringHelper::make_slug($data['name']);
    $originalSlug = $slug;
    $count = 1;

    // Vòng lặp kiểm tra trùng, nếu trùng thì tăng số đếm ở đuôi
    while ($this->repository->existsBySlug($slug)) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    $data['slug'] = $slug;
    return $this->repository->create($data);
}
    public function deleteCategory($id) {
        
        
        return $this->repository->delete($id);
    }

    public function getList() {
        return $this->repository->getAll();
    }
    public function getById($id) {
    return $this->repository->findById($id);
}

public function updateCategory($id, $data) {
    $data['slug'] = \App\Helpers\StringHelper::make_slug($data['name']);
    return $this->repository->update($id, $data);
}
    
}