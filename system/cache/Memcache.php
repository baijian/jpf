<?php
class Cache_Memcache {

    private $virtual_nodes = 32;
    private $server_count;
    private $server_nodes = array();
    private $node_server = array();
    private $node_server_sorted = false;

    public function __construct($v_nodes = null) {
        if(!empty($v_nodes)) {
            $this->virtual_nodes = $v_nodes;
        }
    }

    public function addServerNode($server) {
        if(!isset($this->server_nodes[$server])) {
            $this->server_nodes[$server] = array();
            for($i = 0; $i < $this->virtual_nodes; $i++) {
                $node_position = sprintf("%u",crc32($server.$i));
                $this->node_server[$node_position] = $server;
                $this->server_nodes[$server][] = $node_position;
            }
            $this->node_server_sorted = false;
            $this->server_count++;
        }
    }

    public function addServerNodes($servers) {
        foreach($servers as $server) {
            $this->addServerNode($server);
        }
    }

    public function removeServerNode($server) {
        if(isset($this->server_nodes[$server])) {
            foreach($this->server_nodes[$server] as $node_position) {
                unset($this->node_server[$node_position]);
            } 
            unset($this->server_nodes[$server]);
            $this->server_count--;
        }
    }

    public function getServers() {
        return array_keys($this->server_nodes);
    }

    public function chooseServer($key) {
        $result_server = "";
        if(!empty($this->node_server)) {
            $keyPosition = sprintf("%u",crc32($key));
            $this->sortNodePosition();
            $mutex = 0;
            foreach($this->node_server as $node_position => $server) {
                if($mutex === 0) {
                    $result_server = $server;
                }
                if($node_position > $keyPosition) {
                    $result_server = $server;
                    break;
                }
                $mutex++;
            }
        }
        return $result_server;
    }
    
    private function sortNodePosition() {
        if(!$this->node_server_sorted) {
            ksort($this->node_server);
            $this->node_server_sorted = true;
        }
    }
}

