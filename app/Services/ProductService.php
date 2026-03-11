<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {
    protected $repo;

    public function __construct() {
        $this->repo = new ProductRepository();
    }

    public function listAll() { 
        return $this->repo->getAll(); 
    }

    public function getProduct($id) { 
        return $this->repo->findById($id); 
    }
  public function getPaginated($page = 1, $perPage = 8, $categoryId = null) {
    $products = $this->repo->getByPage($page, $perPage, $categoryId);
    
    $totalProducts = $this->repo->countByStatus(1, $categoryId); 
    $totalPages = ceil($totalProducts / $perPage);

    return [
        'products' => $products,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];
}
public function getAdminPaginated($page = 1, $perPage = 10) {
    $products = $this->repo->getByPageAdmin($page, $perPage);
    $totalProducts = $this->repo->countAll();
    $totalPages = ceil($totalProducts / $perPage);

    return [
        'products' => $products,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];
}

    public function saveProduct($data, $file) {
        $data['slug'] = $this->createSlug($data['name']);
        $data['image'] = $this->uploadImage($file);
        $data['status'] = $data['status'] ?? 1;

        return $this->repo->create($data);
    }

    public function updateProduct($id, $data, $file) {
        $oldProduct = $this->repo->findById($id);
        if (!$oldProduct) return false;

        $data['slug'] = $this->createSlug($data['name']);
        
        if (!empty($file['name'])) {
            if (!empty($oldProduct['image'])) {
                $oldPath = "assets/uploads/products/" . $oldProduct['image'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $data['image'] = $this->uploadImage($file);
        } else {
            $data['image'] = $oldProduct['image'];
        }
        
        $data['status'] = $data['status'] ?? $oldProduct['status'];
        
        return $this->repo->update($id, $data);
    }

    public function removeProduct($id) {
        $product = $this->repo->findById($id); 
        if ($product) {
            if (!empty($product['image'])) {
                $path = "assets/uploads/products/" . $product['image'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            return $this->repo->delete($id);
        }
        return false;
    }

    private function uploadImage($file) {
        if (empty($file['name'])) return null;
        
        $targetDir = "assets/uploads/products/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($file["name"]);
        $targetFile = $targetDir . $fileName;
        
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $fileName;
        }
        return null;
    }

    private function createSlug($string) {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '/[^a-zA-Z0-9\-\_]/',
        );
        $replace = array('a', 'e', 'i', 'o', 'u', 'y', 'd', '-', );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        return strtolower(trim($string, '-'));
    }
}