<?php
class Utils_Encrypt {

    public function des($string, $key) {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $str = mcrypt_encrypt(MCRYPT_DES, $key, $string, MCRYPT_MODE_ECB, $iv);
        return base64_encode($str);
    }
}
