<?php
class Utils_Util {

    public static function exchange(&$a, &$b){
        $tmp = $a;
        $a = $b;
        $b = $tmp;
        return $a + $b;
    }
}
