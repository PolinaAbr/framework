<?php

namespace polinaframework\core;

class Application {
    private $template = "";
    private $templatePath = "";
    public $corePath = "";
    private static $instance = null;

    private function __clone() {

    }

    private function __construct() {
        $this->corePath = dirname(__DIR__);
        $this->template = $this->getConfig('site')['template'];
        $this->templatePath = $this->corePath . "/templates/" . $this->template;
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function includeHeader() {
        $this->includeFile($this->templatePath . "/header.php");
    }

    public function includeFooter() {
        $this->includeFile($this->templatePath . "/footer.php");
    }

    public function getConfig($type = false) {
        $config = include $this->corePath . "/.config";
        switch ($type) {
            case 'db':
                return $config['db'];
                break;
            case 'site':
                return $config['site'];
                break;
            default:
                return $config;
                break;
        }
    }

    public function includeFile($path) {
        if (file_exists($path)) {
            include $path;
        }
    }
}