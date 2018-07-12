<?php

namespace Polinaframework\Core;

class Application {
    private $template = "";
    private $templatePath = "";
    private $corePath = "";
    private static $instance = null;
    private $__components = array();
    private $pager = null;
    private $isBuffer = false;

    private function __clone() {

    }

    private function __construct() {
        $this->corePath = $_SERVER['DOCUMENT_ROOT'] . "/polinaframework";
        $this->template = $this->getConfig('site')['templates'];
        if ($this->template == '') {
            $this->template = '.default';
        }
        $this->templatePath = "/polinaframework/templates/" . $this->template;
        $this->pager = Pager::getInstance();
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getPager() {
        return $this->pager;
    }


    public function includeFile($path) {
        if (file_exists($path)) {
            include $path;
        }
    }

    public function getCorePath() {
        return $this->corePath;
    }

    public function getTemplatePath($full = true) {
        if ($full) {
            return $_SERVER['DOCUMENT_ROOT'] . $this->templatePath;
        }
        return $this->templatePath;
    }

    public function getConfig($type = false) {
        $config = include $this->corePath . "/.config";
        if ($type && $config[$type]) {
            return $config[$type];
        }
        return $config;
    }

    private function startBuffer() {
        ob_start();
        $this->isBuffer = true;
    }

    public function restartBuffer() {
        if ($this->isBuffer) {
            ob_clean();
        }
    }

    private function endBuffer() {
        if ($this->isBuffer) {
            ob_end_clean();
            $this->isBuffer = false;
        }
    }

    private function outputContent() {
        //получить все строки для замены
        //получить контент, заменить все макросы на строки
        //вывод контента
        //закончить работу с буфером
        $replace = Pager::getInstance()->getReplaceArray();
        $content = ob_get_contents();
        foreach ($replace as $macros => $value) {
            $content = str_replace($macros, $value, $content);
        }
        $this->endBuffer();
        echo $content;
    }

    public function showProperty($id) {
        $this->pager->showProperty($id);
    }


    public function setProperty($id, $prop) {
        //устанавливает в массиве prop значение по id
        $this->pager->setProperty($id, $prop);
    }

    public function getProperty($id) {
        return $this->pager->getProperty($id);
    }

    public function addScript($src) {
        //добавляет в массив scripts
        //приидет путь
        //с тегами
        $this->pager->addScript($src);
    }

    public function addCss($link) {
        $this->pager->addCss($link);
    }

    public function addHeadString($str) {
        $this->pager->addHeadString($str);
    }

    public function showHead() {
        //вызывает 3 метода showCss, showScripts, showHeadStrings
        $this->pager->showCss();
        $this->pager->showScripts();
        $this->pager->showHeadStrings();
    }


    public function includeHeader() {
        $this->startBuffer();
        $this->includeFile($this->getTemplatePath() . "/header.php");
    }

    public function includeFooter() {
        $this->includeFile($this->getTemplatePath() . "/footer.php");
        $this->outputContent();
    }

    function includeComponent($name, $template = "", $params = array()) {
        if (!$this->__components[$name]) {
            $classes = get_declared_classes(); //массив подключенных классов
            $this->includeFile($this->getCorePath() . "/components/$name/class.php");
            //array_diff расхождение массивов
            foreach (array_diff(get_declared_classes(), $classes) as $class) {
                //обязательно дб дочерним класса Component
                if (is_subclass_of($class, "Polinaframework\Core\Component")) {
                    $this->__components[$name] = $class;
                    break;
                }
            }
        }
        if ($this->__components[$name]) {
            $component = new $this->__components[$name]($name, $template, $params);
            $component->execute();
        }
        //подключение компонентов из массива
        //вызов метода execute того компонента, который мы указали
        //если подключили компонент, помещаем его в массив __components и при следующем обращении проверяем, есть ли в массиве и берем из массива имя
    }

    public function isPage($page) {
        return $this->pager->isPage($page);
    }

    public function isMain() {
         return $this->pager->isPage("main");
    }

    public function is404() {
        return $this->pager->isPage("404");
    }

    public function set404() {
        if ($this->is404()) return;
        echo "Error";
    }
}