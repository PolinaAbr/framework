<?php

namespace Polinaframework\Core\DB;

class DBResult {
    private $result = null;
    private $count = 0;

    public function __construct($result) {
        $this->result = $result;
        $this->count = mysqli_num_rows($result);
    }

    public  function fetch() {
        return mysqli_fetch_assoc($this->result);
    }

    public function  getCount() {
        return $this->count;
    }
}