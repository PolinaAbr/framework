<?php

namespace Polinaframework\Core;

abstract class Component {
    protected $result = array();
    protected $params = array();
    private $name = "";
    protected $template = "";
    protected $templatePath = "";

    abstract function  execute();

    function __construct($name, $template = "", $params = array()) {
        $this->name = $name;
        if ($template === "") {
            $template = ".default";
        }
        $this->template = $template;
        $this->params = $params;
        $this->templatePath = "/components/".$this->name."/templates/".$this->template;
    }

    public function includeTemplate($page = "template") {
        $params = $this->params;
        $result = $this->result;
        $templatePath = Application::getInstance()->getCorePath() . $this->templatePath;
        //подключение шаблона
        if (file_exists($templatePath . "/result_modifier.php")) {
            include($templatePath . "/result_modifier.php");
        }
        if (file_exists($templatePath . "/" . $page . ".php")) {
            include($templatePath . "/" . $page . ".php");
        }
    }

    public function explodeUri($returnParams = false) {
        $requestParams = "";
        $requestUri = $_SERVER["REQUEST_URI"];
        //отделяем get-параметры от url
        if ($pos = strpos($requestUri, "?")) {
            $requestParams = substr($requestUri, $pos);
            $requestUri = substr($requestUri, 0, $pos);
        }
        if ($returnParams) {
            return $requestParams;
        }
        //удаляем первый и последний слеши
        if ($requestUri[0] == "/") {
            $requestUri = substr($requestUri, 1);
        }
        if ($requestUri[strlen($requestUri) - 1] == "/") {
            $requestUri = substr($requestUri, 0, strlen($requestUri) - 1);
        }
        return explode("/", $requestUri);
    }

}