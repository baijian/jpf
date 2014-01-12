<?php
class Cache_Redis {

    private $redis = null;
    private $host = 'localhost';//default localhost
    private $port = 6379;//default 6379 port
    private $timeout = 3;//default 3 sec
    private $retry_interval = 100;//default 100ms

    public function __construct() {
        $this->redis = new Redis();
    }

    public function ping() {
        return $this->redis->ping();
    }

    public function auth($user) {
        return $this->redis->auth($user);
    }

    public function __destruct() {
        $this->redis->close();
    }
}
