<?php
namespace App\Services;

use App\Repositories\UserRepository;


class AuthService {
    protected $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

   
    public function createUser($data) {
        $user = $this->userRepository->findByEmail($data['email']);
        if ($user) {
            return false; 
        }

        return $this->userRepository->create($data);
    }

    
    public function login($email, $password) {
        $user = $this->userRepository->findByEmail($email);
        
        
        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }
        
        return false; 
    }
}