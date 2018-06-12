<?php

namespace Polinaframework\Core\DB\Validators;
use Polinaframework\Core\Tables\UserTable;

class Type {
    public function validate($data, $field)
    {
        $map = UserTable::getMap();
        if ($map[$field]['data_type'] !== gettype($data) && settype($data, $map[$field]['data_type'])) {
            echo "Неверный тип поля <b>$field</b><br>";
            return false;
        }
        return true;
    }
}