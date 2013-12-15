<?php
class Utils_Curl {

    private $ch = null;				
    private $status_code = null;
    private $response_headers = null;

    private $setopt = array(
        CURLOPT_PORT => '80',
        CURLOPT_CONNECTTIMEOUT => '10',
        CURLOPT_TIMEOUT => '10',
        CURLOPT_ENCODING => 'gzip',
        //CURLOPT_FOLLOWLOCATION => '1',
        CURLOPT_HEADER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_BINARYTRANSFER => true,
    );

    public function __construct($setopt=array()) {

        function_exists('curl_init') || die('CURL Library Not Loaded');	
        $this->setopt = array_merge($this->setopt,$setopt);		
        $this->ch = curl_init();
        curl_setopt_array($this->ch, $this->setopt);
    }

    /**
     * @return array
     */
    public function get_version_info() {
        return curl_version();
    }

    /**
     * @param $url string
     * @param $params array
     * @return string
     */
    public function get_with_params($url, $params) {
        return $this->get($url, $params);
    }

    /**
     * @param $url string
     * @param $params array
     * @param $headers array(
     *        'Content-type: text/plain',
     *        'Content-type: application/x-www-form-urlencoded',
     *        'Content-type: multipart/form-data',
     *        'Content-length: 100',
     * )
     * @return string
     */
    public function get_with_params_headers($url, $params, $headers) {
        return $this->get($url, $params, $headers);
    }

    /**
     * @param $url string
     * @return string
     */
    public function get($url, $params = null, $headers = null) {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
        if ($headers != null) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($params !== null) {
            $p = "?";
            foreach($params as $key => $val) {
                $p .= $key . "=" . urlencode($val) . "&";
            }
            $p = rtrim($p, "&");
            $url .= $p;
        }
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $result = curl_exec($this->ch);
        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $this->response_headers = substr($result, 0, $header_size);
        $result = substr($result, $header_size);
        if (curl_errno($this->ch) === 0) {
            return $result;
        } else {
            return $this->get_error_info();
        }
    }

    /**
      * @param $url string
      * @param $params array
      * @return string
      */
    public function post_with_params($url, $params) {
        return $this->post($url, $params);
    }

    /**
     * @param $url string
     * @param $params array
     * @param $headers array
     * @return string
     */
    public function post_with_params_headers($url, $params, $headers) {
        return $this->post($url, $params, $headers);
    }

    /**
     * @param $url string
     * @return string
     */
    public function post($url, $params = null, $headers = null) {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        if ($headers != null) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($params != null) {
            if (is_array($params) && !empty($params)) {
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($params));
            }else {
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
            }
        }
        $result = curl_exec($this->ch);
        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $this->response_headers = substr($result, 0, $header_size);
        $result = substr($result, $header_size);
        if (curl_errno($this->ch) === 0) {
            return $result;
        } else {
            return $this->get_error_info();
        }
    }

    /**
     * @return int
     */
    public function get_status_code() {
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }
    
    /**
     * @return string
     */
    public function get_response_headers() {
        return $this->$response_headers;
    }

    /**
     * @return string
     */
    private function get_error_info() {
        $error = "ENo: " . curl_errno($this->ch) . "\t";
        $error .= "EMs: " . curl_error($this->ch);
        return $error;
    }

    public function __destruct() {
        curl_close($this->ch);
    }
}
