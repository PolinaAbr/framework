<?php

namespace Polinaframework\Core\Tables\Blog;
use Polinaframework\Core\DB\Table;
use Polinaframework\Core\DB\Validators\Length;
use Polinaframework\Core\DB\Validators\Type;
use Polinaframework\Core\DB\Validators\Unique;

class BlogTable extends Table{
    public static function getTableName() {
        return "PF_BLOG";
    }

    public static function getMap() {
        return array (
            'id' =>
                array (
                    'data_type' => 'integer',
                    'primary' => true,
                    'required' => true,
                    'autocomplete' => true,
                ),
            'date_insert' =>
                array (
                    'data_type' => 'date',
                    'required' => true
                ),
            'date_change' =>
                array (
                    'data_type' => 'date',
                    'required' => true
                ),
            'active' =>
                array (
                    'data_type' => 'date',
                    'required' => true,
                    'validate' => 'validateActive',
                ),
            'code' =>
                array (
                    'data_type' => 'date',
                    'required' => true,
                    'validate' => 'validateCode',
                ),
            'name' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validateName',
                ),
        );
    }

//    public static function validateActive($value) {
//        $type = new Type();
//        $result = array(
//            $type->validate($value, 'active')
//        );
//        foreach ($result as $item) {
//            if ($item === false) {
//                return false;
//            }
//        }
//        return true;
//    }
//
//    public static function validateCode($value) {
//        $type = new Type();
//        $unique = new Unique();
//        $length = new Length();
//        $result = array(
//            $type->validate($value, 'code'),
//            $unique->validate($value, 'code', self::getTableName()),
//            $length->validate($value, 'code', 5, 20)
//        );
//        foreach ($result as $item) {
//            if ($item === false) {
//                return false;
//            }
//        }
//        return true;
//    }
//
//    public static function validateName($value) {
//        $type = new Type();
//        $length = new Length();
//        $result = array(
//            $type->validate($value, 'name'),
//            $length->validate($value, 'name', 5, 20)
//        );
//        foreach ($result as $item) {
//            if ($item === false) {
//                return false;
//            }
//        }
//        return true;
//    }
//
//    public static function validatePassword($value)
//    {
//        $type = new Type();
//        $length = new Length();
//        $result = array(
//            $type->validate($value, 'password'),
//            $length->validate($value, 'password', 5, 30)
//        );
//        foreach ($result as $item) {
//            if ($item === false) {
//                return false;
//            }
//        }
//        return true;
//    }
}