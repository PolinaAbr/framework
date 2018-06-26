<?php

namespace Polinaframework\Core\Tables\Blog;
use Polinaframework\Core\DB\Table;

class SectionTable extends Table {

    public static function getTableName() {
        return "PF_BLOG_SECTION";
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


}