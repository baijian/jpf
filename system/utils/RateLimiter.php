<?php
require_once '../cache/Redis.php';
class Utils_RateLimiter extends Cache_Redis {
    
    public function __construct() {
    }

    public function getRateTimes($prefix, $key) {
    }

    public function rateLimiterInit($prefix, $key) {
    }

    public function rateLimiterAdd($prefix, $key) {
    }
}
