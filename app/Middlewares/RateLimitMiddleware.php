<?php
namespace App\Middlewares;

use Predis\Client as RedisClient;

class RateLimitMiddleware {
    private $redis;

    public function __construct() {
        $config = require __DIR__ . '/../../config/redis.php';
        $this->redis = new RedisClient($config);
    }

    public function handle() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $key = "rate_limit:" . $ip;
        
        $current = $this->redis->incr($key);
        
        if ($current == 1) {
            $this->redis->expire($key, 60);
        }

        
        if ($current > 60) {
            http_response_code(429); 
            die("Bạn đang thao tác quá nhanh. Vui lòng thử lại sau 1 phút!");
        }
    }
}