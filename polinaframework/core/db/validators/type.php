<?php

namespace polinaframework\core\db\validators;
use polinaframework\core\tables\UserTable;

class Type {
    public function validate($data, $field)
    {
        $map = UserTable::getMap();
        if ($map[$field]['data_type'] !== gettype($data)) {
            echo "Неверный тип поля <b>$field</b><br>";
            return false;
        }
        return true;
    }
}