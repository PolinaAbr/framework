<?php

namespace polinaframework\core\db\validators;

class Length {
    public function validate($data, $field, $min, $max)
    {
        if (strlen($data) < $min) {
            echo "�������� ���� <b>$field</b> ������� ��������<br>";
            return false;
        } elseif (strlen($data) > $max) {
            echo "�������� ���� <b>$field</b> ������� �������<br>";
            return false;
        }
        return true;
    }
}