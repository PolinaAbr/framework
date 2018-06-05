<?php

namespace polinaframework\core\db;
use polinaframework\core\Application;

final class DB {
    private $tables = array();
    private  static $instance = null;
    private $connect = null;

    private function __construct() {
        $this->setConnect();
    }

    protected function __clone() {

    }

    static public function getInstance() {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getTable($name) {
        if (!$this->tables[$name]) {
            $tableName = ucwords($name . "Table");
            $this->tables[$name] = false;
            if (class_exists($tableName)) {
                $this->tables[$name] = new $tableName();
            }
        }
        return $this->tables[$name];
    }

    private function setConnect() {
        $config = $this->getConfig();
        $this->connect = mysqli_connect($config['host'], $config['user'], $config['password'], $config['db']);
        if (!$this->connect) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }

    private function getConfig() {
        $params = Application::getInstance()->getConfig('db');
        return array('host' => $params['host'], 'user' => $params['root'], 'password' => $params['password'], 'db' => $params['pf_db']);
    }

    public function query($query) {
        if (!mysqli_query($this->connect, $query)) {
            echo "Ошибка. Запрос к базе данных не выполнен<br>";
            return false;
        } else {
            return new DBresult(mysqli_query($this->connect, $query));
        }
    }
}