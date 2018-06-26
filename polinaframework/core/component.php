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
}