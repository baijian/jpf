<?php
class Utils_Decrypt {

    public function des($str, $key) {
        $string = base64_decode($str);
        $cipher = MCRYPT_DES;
        $modes = MCRYPT_MODE_ECB;
        $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $modes), MCRYPT_RAND);
        return mcrypt_decrypt($cipher, $key, $string, $modes, $iv);
    }
}
