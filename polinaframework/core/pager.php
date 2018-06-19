<?php

namespace Polinaframework\Core;

class Pager {
    private static $instance = null;
    private $scripts = array();
    private $styles = array();
    private $strings = array();
    private $properties = array();
    private $macrosKeys = array("css" => "CSS", "js" => "SCRIPTS", "str" => "STRINGS", "prop" => "PROPERTY_");


    private function __clone() {

    }

    private function __construct() {

    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function setProperty($id, $prop) {
        //устанавливает в массиве prop значение по id
        $this->properties[$id] = $prop;
    }

    public function getProperty($id) {
        return $this->properties[$id];
    }

    public function addScript($src) {
        //добавляет в массив scripts
        //приидет путь
        //с тегами
        $this->scripts[$src] = "<script src='".$src."'></script>";
    }

    public function addCss($link) {
        $this->styles[$link] = '<link href="' . $link . '" rel="stylesheet" type="text/css">';
    }

    public function addHeadString($str) {
        $this->strings[] = $str;
    }

    public function showCss() {
        //в месте, где вызывается метод, должен остаться макрос
        echo $this->getMacros($this->macrosKeys["css"]);
    }

    public function showScripts() {
        echo $this->getMacros($this->macrosKeys["js"]);
    }

    public function showHeadStrings() {
        echo $this->getMacros($this->macrosKeys["str"]);
    }

    public function showProperties($id) {
        echo $this->getMacros($this->macrosKeys["prop"] . $id);
    }

    private function getMacros($param) {
        return "#PF_CORE_" . $param . "#";
    }

    public function showHead() {
        //вызывает 3 метода showCss, showScripts, showHeadStrings
        $this->showCss();
        $this->showScripts();
        $this->showHeadStrings();
    }

    public function getReplaceArray() {
        $replace = array();
        if ($scripts = $this->getReplace("scripts")) {
            $replace[$this->getMacros($this->macrosKeys["js"])] = $scripts;
        }
        if ($styles = $this->getReplace("styles")) {
            $replace[$this->getMacros($this->macrosKeys["css"])] = $styles;
        }
        if ($str = $this->getReplace("strings")) {
            $replace[$this->getMacros($this->macrosKeys["str"])] = $str;
        }
        if ($prop = $this->getReplaceProperties()) {
            $replace = array_merge($replace, $prop);
        }
        return $replace;
    }

    private function getReplace($param) {
        $return = "";
        $validate = array("scripts", "styles", "strings");
        if (!in_array($param, $validate)) {
            return $return;
        }
        if (count($this->$param) > 0) {
            $return = implode("/n", $this->$param);
        }
        return $return;
    }

    private function getReplaceProperties() {
        $prop = array();
        foreach ($this->properties as $id => $value) {
           $prop[$this->getMacros($this->macrosKeys["prop"] . $id)] = $value;
        }
        return $prop;
    }
}