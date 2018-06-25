<?php

namespace Polinaframework\Core\Tables\Blog;
use Polinaframework\Core\DB\Table;
use Polinaframework\Core\DB\Validators\Length;
use Polinaframework\Core\DB\Validators\Type;
use Polinaframework\Core\DB\Validators\Unique;

class ElementsTable extends Table {

    public static function getTableName() {
        return "PF_BLOG_ELEMENTS";
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
                    'required' => true,
                ),
            'date_change' =>
                array (
                    'data_type' => 'date',
                    'required' => true,
                ),
            'active' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validateActive',
                ),
            'code' =>
                array (
                    'data_type' => 'string',
                    'unique' => true,
                    'required' => true,
                    'validate' => 'validateCode',
                ),
            'name' =>
                array (
                    'data_type' => 'string',
                    'unique' => true,
                    'required' => true,
                    'validate' => 'validateName',
                ),
            'tags' =>
                array (
                    'data_type' => 'string',
                    'validate' => 'validateTags',
                ),
            'preview_text' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validatePreview',
                ),
            'detail_text' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validateDetail',
                ),
            'section_id' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validateSectionID',
                ),
            'blog_id' =>
                array (
                    'data_type' => 'string',
                    'required' => true,
                    'validate' => 'validateBlogId',
                ),
        );
    }

//    public static function validateUsername($value) {
//        $type = new Type();
//        $unique = new Unique();
//        $length = new Length();
//        $result = array(
//            $type->validate($value, 'username'),
//            $unique->validate($value, 'username', self::getTableName()),
//            $length->validate($value, 'username', 5, 20)
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