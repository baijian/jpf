<?php
class Utils_Resource {

    public function get_config($key, $file) {
        @include("$file");
        if (isset($config["$key"])) {
            return $config["$key"]
        } else {
            return false;
        }
    }
}
