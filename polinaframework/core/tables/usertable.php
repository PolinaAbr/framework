<?php

namespace Polinaframework\Core\Tables;
use Polinaframework\Core\DB\Table;
use Polinaframework\Core\DB\Validators\Length;
use Polinaframework\Core\DB\Validators\Type;
use Polinaframework\Core\DB\Validators\Unique;

class UserTable extends Table {

    public static function getTableName() {
        return "PF_USER";
    }

    public static function getMap() {
        return array (
            'user_id' =>
                array (
                    'data_type' => 'integer',
                    'primary' => true,
                    'required' => true,
                    'autocomplete' => true,
                ),
            'username' =>
                array (
                    'data_type' => 'string',
                    'unique' => true,
                    'required' => true,
                    'validate' => 'validateUsername',
                ),
            'password' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validatePassword',
                ),
        );
    }

    public static function validateUsername($value) {
        $type = new Type();
        $unique = new Unique();
        $length = new Length();
        $result = array(
            $type->validate($value, 'username'),
            $unique->validate($value, 'username', self::getTableName()),
            $length->validate($value, 'username', 5, 20)
        );
        foreach ($result as $item) {
            if ($item === false) {
                return false;
            }
        }
        return true;
    }

    public static function validatePassword($value)
    {
        $type = new Type();
        $length = new Length();
        $result = array(
            $type->validate($value, 'password'),
            $length->validate($value, 'password', 5, 30)
        );
        foreach ($result as $item) {
            if ($item === false) {
                return false;
            }
        }
        return true;
    }
}