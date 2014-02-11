<?php
class Utils_Util {

    public static function exchange(&$a, &$b){
        $tmp = $a;
        $a = $b;
        $b = $tmp;
        return $a + $b;
    }

    /**
     * 必须包含数字字母和特殊字符
     * TODO 使用正则搜索函数搜索是否包含数字字母及特殊字符等,不过效率也许有所下降
     */
    public static function verifyPassword($password) {
        if (preg_match('/^([[:alpha:]]|\d|[[:punct:]])*([[:punct:]]+[[:alpha:]]+\d+|[[:punct:]]+\d+[[:alpha:]]+|\d+[[:punct:]]+[[:alpha:]]+|\d+[[:alpha:]]+[[:punct:]]+|[[:alpha:]]+[[:punct:]]+\d+|[[:alpha:]]+\d+[[:punct:]]+)+([[:alpha:]]|\d|[[:punct:]])*$/', $password)) {
            return true;
        } else {
            return false;
        }
    }
}
