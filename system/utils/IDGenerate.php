<?php
class Utils_IDGenerate {

    public function get_id_by_time() {
        //length 10 + 4
        return sprintf("%.0f", microtime(true) * 10000);
    }
}
