<?php

namespace polinaframework\core\db\validators;
use polinaframework\core\db\DB;

class Unique {
    public function validate($data, $field, $table)
    {
        $query = "select * from $table where $field='$data'";
        $result = DB::getInstance()->query($query);
        if ($result->num_rows !== 0) {
            echo "Поле <b>$field</b> со значением <b>$data</b> уже есть в таблице <b>" . $table . "</b><br>";
            return false;
        }
        return true;
    }
}