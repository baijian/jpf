<?php
require_once("Curl.php");
class Log {
    
    private $url = null;
    private $log = null;

    public function __construct() {
        register_shutdown_function(array($this, 'send_log'));
    }

    /**
     * @param $url string
     */
    public function set_url($url) {
        $this->url = $url;
    }

    /**
     * @param $json_log string
     */
    public function set_log($json_log) {
        $this->log = $json_log;
    }

    /**
     * @desc shutdown function
     */
    public function send_log() {
        if ($this->url !== null && $this->log !== null) {
            $ch = new Curl();
            $ch->post_with_params($this->url, array("data" => $this->log));
        }
    }
}
