<?php

namespace polinaframework\core\db\validators;

class Length {
    public function validate($data, $field, $min, $max)
    {
        if (strlen($data) < $min) {
            echo "Значение поля <b>$field</b> слишком короткое<br>";
            return false;
        } elseif (strlen($data) > $max) {
            echo "Значение поля <b>$field</b> слишком длинное<br>";
            return false;
        }
        return true;
    }
}