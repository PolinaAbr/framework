<?php

namespace polinaframework\core\db;

abstract class Table
{
    protected static $map = array();

    public function __construct() {
    }

    public static function getTableName() {
        return null;
    }

    protected static function getMap() {
        return array();
    }

    public static function add(array $data) {
        static::$map = static::getMap();
        $queryFields = "";
        $queryValues = "";
        $validation = false;
        $class = static::class;
        foreach (static::$map as $field => $property) {
            if (!$data[$field] && $property['required'] && !$property['autocomplete']) {
                echo "Ошибка. Поле <b>$field</b> в таблице <b>" . static::getTableName() . "</b> обязательное.<br>";
                $validation = false;
                break;
            }

            if ($property['validate'] && !$validation = $class::$property['validate']($data[$field])) {
                //$validation = $class::$property['validate']($data[$field]);
                break;
            }
//                $validation = static::validate($field, $data[$field]);
            $queryFields .= $field . ", ";
            if (gettype($data[$field]) === 'integer') {
                $queryValues .= "$data[$field], ";
            } else {
                $queryValues .= "'$data[$field]', ";
            }

        }
        if ($validation) {
            $queryFields = substr($queryFields, 0, strlen($queryFields) - 2);
            $queryValues = substr($queryValues, 0, strlen($queryValues) - 2);
            $query = "insert into " . static::getTableName() . "(" . $queryFields . ") values(" . $queryValues . ")";
//            debug($query);
//            DB::getInstance()->query($query);
        }
    }

    public static function update($id, array $data) {
        $class = static::class;
        $map = static::$map;
        $field = array_keys($map)[0];
        $validation = false;
        $query = "update " . static::getTableName() . " set ";
        foreach ($data as $key => $value) {
            if ($key === $field) {
                break;
            } elseif (static::$map[$key] && $class::$map[$key]['validate']($value)) {
                $query .= "$key='$data[$key]', ";
                $validation = true;
            }
            if ($validation) {
                $query = substr($query, 0, strlen($query) - 2);
                $query .= " where $field=$id";
//                debug($query);
                //            DB::getInstance()->query($query);
            }
        }
    }

    public static function delete($id) {
        $field = array_keys(static::$map)[0];
        $query = "delete from " . static::getTableName() . " where $field=$id";
//        debug($query);
//        DB::getInstance()->query($query);
    }

    public static function getList($data) {
        $query = "select * from " . static::getTableName();
        foreach ($data as $key => $item) {
            switch ($key) {
                case 'select':
                    $query = "select ";
                    foreach ($item as $field) {
                        $query .= $field . ", ";
                    }
                    $query = substr($query, 0, strlen($query) - 2) . " from " . static::getTableName();
                    break;
                case 'filter':
                    $query .= " where ";
                    foreach ($item as $field => $value) {
                        if (strpos($field, "!" === 0)) {
                            $query .= "not ";
                            $field = substr($field, 1, strlen($field));
                        }
                        if (is_array($value)) {
                            $query .= "$field between $value[0] and $value[1] and ";
                        } else {
                            $array = explode(", ", $value);
                            for ($i = 0; $i < count($array); $i++) {
                                $char = substr($array[$i], 0, 1);
                                switch ($char) {
                                    case ">":
                                        $array[$i] = substr($array[$i], 1, strlen($array[$i]));
                                        $query .= "$field>$array[$i] or";
                                        break;
                                    case "<":
                                        $array[$i] = substr($array[$i], 1, strlen($array[$i]));
                                        $query .= "$field<$array[$i] or";
                                        break;
                                    case "%":
                                        $array[$i] = substr($array[$i], 1, strlen($array[$i]));
                                        $query .= "$field like '%$array[$i]%' or";
                                        break;
                                    default:
                                        $query .= "$field='$array[$i]' or ";
                                        break;
                                }
                            }
                            $query = substr($query, 0, strlen($query) - 4) . " and ";
                        }
                    }
                    $query = substr($query, 0, strlen($query) - 5);
                    break;
                case 'order':
                    $query .= " order by " . key($item) . " " . $item[key($item)];
                    break;
                case 'limit':
                    $query .= " limit $item";
                    break;
            }
        }
//        debug($query);
        $result = DB::getInstance()->query($query);
        return $result;
    }
}