<?php
class Utils_Password {

    public function get_salt() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function salt_hash($salt, $password) {
        return hash('sha256', $salt . $password);
    }
}
