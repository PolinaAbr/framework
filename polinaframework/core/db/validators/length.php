<?php

namespace Polinaframework\core\DB\Validators;

class Length {
    public function validate($data, $field, $min, $max)
    {
        if (strlen($data) < $min && strlen($data) > $max) {
            echo "Количество символов поля <b>$field</b> должно быть от $min до $max<br>";
            return false;
        }
        return true;
    }
}