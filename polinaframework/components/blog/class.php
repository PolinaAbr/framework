<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Application;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\BlogTable;
use Polinaframework\Core\Tables\Blog\ElementsTable;
use Polinaframework\Core\Tables\Blog\SectionTable;

class Blog extends Component
{
//    private $sectionId = null;
//    private $section = null;
//    private $element = null;
    private $field;

    private function prepareParams()
    {
        if (!$this->params["blog_id"] || $this->params["blog_id"] == 0) {
            $requestUri = $_SERVER["REQUEST_URI"];
            if ($pos = strpos($requestUri, "?")) {
                $requestUri = substr($requestUri, 0, $pos);
            }
            $requestUri = $this->explodeUri($requestUri);
            $result = BlogTable::getList(
                array(
                    "select" => array("ID"),
                    "filter" => array("CODE" => $requestUri[0])
                )
            );
            if ($result->getCount() == 1) {
                $this->params["blog_id"] = $result->fetch()["ID"];
            }
        }
        if (!$this->params["sort_order"]) {
            $this->params["sort_order"] = "DATE_INSERT";
        }
        if (!$this->params["sort_by"]) {
            $this->params["sort_by"] = "desc";
        }
        if (!$this->params["rules"] || $this->params["rules"] == "") {
            $this->params["rules"] = array(
                "sections" => "",
                "section" => "/dev/#SECTION_CODE#/",
                "detail" => "/dev/#SECTION_CODE_PATH#/#ELEMENT_CODE#/"
            );
        }
    }

//    public function execute()
//    {
//        $this->prepareParams();
//        $sectionRules = explode("#", $this->params["rules"]["section"]);
//        switch ($sectionRules[count($sectionRules) - 2]) {
//            case "SECTION_CODE":
//                $this->section = "CODE";
//                break;
//            case "SECTION_ID":
//                $this->section = "ID";
//        }
//        $detailRules = explode("#", $this->params["rules"]["detail"]);
//        switch ($detailRules[count($detailRules) - 2]) {
//            case "ELEMENT_CODE":
//                $this->element = "CODE";
//                break;
//            case "ELEMENT_ID":
//                $this->element = "ID";
//        }
////        $uri404 = "http://" . $_SERVER["SERVER_NAME"] . "/404.php";
//        $requestUri = $_SERVER["REQUEST_URI"];
//        $isUriRight = false;
//        $isElement = false;
//        //отделяем get-параметры от url
//        if ($pos = strpos($requestUri, "?")) {
//            $requestParams = substr($requestUri, $pos);
//            $requestUri = substr($requestUri, 0, $pos);
//        }
//        $requestUri = $this->explodeUri($requestUri);
//        if (count($requestUri) == 1) {
//            $template = "section";
//        } else {
//            $last = array_pop($requestUri);
//            if ($this->checkElement($last)) {
//                if (count($requestUri) == 1) {
////                    header("Location: " . $uri404);
//                    Application::getInstance()->set404();
//                }
//                $last = array_pop($requestUri);
//                $isElement = true;
//            }
//            while (count($requestUri) > 0) {
//                $section = $this->checkSection($last);
//                if (!$section || (count($requestUri) == 1 && $this->sectionId != 0)) {
////                    header("Location: " . $uri404);
//                    Application::getInstance()->set404();
//                } else {
//                    $isUriRight = true;
//                }
//                $last = array_pop($requestUri);
//            }
//        }
//        if ($isElement && $isUriRight) {
//            $template = array_search("/dev/#SECTION_CODE_PATH#/#ELEMENT_" . $this->element . "#/", $this->params["rules"]);
//        } elseif ($isUriRight) {
//            $template = array_search("/dev/#SECTION_" . $this->section . "#/", $this->params["rules"]);
//        }
//        $this->includeTemplate($template);
//    }

    public function execute()
    {
        $template = "";
        $templateSection = "";
        $templateElement = "";
        $this->prepareParams();
        $detailRules = explode("#", $this->params["rules"]["detail"]);
        switch ($detailRules[count($detailRules) - 2]) {
            case "ELEMENT_CODE":
                $this->field = "CODE";
                break;
            case "ELEMENT_ID":
                $this->field = "ID";
        }
        $requestUri = $this->explodeUri();
        foreach ($this->params["rules"] as $key => $rule) {
            if (preg_match("(^/\w+/#\w+#/$)", $rule)) {
                $templateSection = $key;
            } elseif (preg_match("(^/\w+/#\w+#/#\w+#/$)", $rule)) {
                $templateElement = $key;
            }
        }
        $template = $templateSection;
        $last = array_pop($requestUri);
        $items = ElementsTable::getList(
            array(
                "select" => array("ID", "CODE", "SECTION_ID"),
                "filter" => array($this->field => $last)
            )
        );
        if ($items->getCount() == 1) {
            $this->result["element_code"] = $last;
            $this->result["section_id"] = $items->fetch()["SECTION_ID"];
            $template = $templateElement;
        } else {
            $this->result["section_code"] = $last;
        }
        $this->includeTemplate($template);
    }


//    private function checkSection($section) {
//        if ($this->sectionId !== null) {
//            $items = SectionTable::getList(
//                array(
//                    "select" => array("CODE", "SECTION_ID", "BLOG_ID"),
//                    "filter" => array("CODE" => $section, "ID" => $this->sectionId)
//                )
//            );
//        } else {
//            $items = SectionTable::getList(
//                array(
//                    "select" => array("ID", "CODE", "SECTION_ID", "BLOG_ID"),
//                    "filter" => array($this->section => $section)
//                )
//            );
//        }
//        if ($items->getCount() == 1) {
//            $item = $items->fetch();
//            $this->sectionId = $item["SECTION_ID"];
//            $this->result["section_code"] = $item["CODE"];
//            if ($item["ID"]) {
//                $this->result["section_id"] = $item["ID"];
//            }
//            return true;
//        }
//        return false;    }
//
//    private function checkElement($element) {
//        $items = ElementsTable::getList(
//            array(
//                "select" => array("ID", "CODE", "SECTION_ID"),
//                "filter" => array($this->element => $element)
//            )
//        );
//        if ($items->getCount() == 1) {
//            $item = $items->fetch();
//            $this->sectionId = $item["SECTION_ID"];
//            $this->result["element_code"] = $item["CODE"];
//            $this->result["element_id"] = $item["ID"];
//            return true;
//        }
//        return false;
//    }
}