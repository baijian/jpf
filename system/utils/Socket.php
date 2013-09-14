<?php
/**
 * @author baijian
 */
class Socket {
    /**
     * @
     */
    public function socket_connection($host, $request_head, 
        $port=80, $timeout=10) 
    {
        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$fp) {
            return "$errstr ($errno)\n";
        } else {
            fwrite($fp, $request_head);
            $result = "";
            while (!feof($fp)) {
                $result .= fgets($fp, 1024);
            }
            fclose($fp);
            return $result;
        }
    }
}
