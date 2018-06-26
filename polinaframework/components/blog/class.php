<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Application;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\BlogTable;
use Polinaframework\Core\Tables\Blog\ElementsTable;
use Polinaframework\Core\Tables\Blog\SectionTable;

class Blog extends Component {
    private $sectionId = null;

    public function execute()
    {
        $isElement = true;
        $isSection = false;
        $this->prepareParams();
        $requestUri = $_SERVER["REQUEST_URI"];
        //отделяем get-параметры от url
        if ($pos = strpos($requestUri, "?")) {
            $requestParams = substr($requestUri, $pos);
            $requestUri = substr($requestUri, 0, $pos);
        }
        $requestUri = $this->explodeUri($requestUri);
        if (count($requestUri) == 1) {
            $this->includeTemplate("section");
        } else {
            while (count($requestUri) > 1) {
                $last = array_pop($requestUri);
                if (!$this->checkElement($last)) {
                    $elem = false;
                    if (!$this->checkSection($last)) {
                        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/404.php")) {
//                            include_once($_SERVER["DOCUMENT_ROOT"] . "/404.php");
                        }
                        echo 5;
//                        $uri = $_SERVER["SERVER_NAME"];
//                        header("Location: https://framework/404.php");
                        break;
                    }
                } else {
                    $last = array_pop($requestUri);
                    var_dump($this->sectionId);
                    if ($this->sectionId !== 0 && !$this->checkSection($last)) {
                        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/404.php")) {
//                            include_once($_SERVER["DOCUMENT_ROOT"] . "/404.php");
                        }
                        echo 5;
//                        $uri = $_SERVER["SERVER_NAME"];
//                        header("Location: https://framework/404.php");
                        break;
                    } else {
                        echo 6;
                    }
                }
            }
        }
        //проверять с конца
    }

    private function prepareParams() {
        if (!$this->params["blog_id"] || $this->params["blog_id"] == 0) {
            die("Не указан идентификатор раздела");
            //раскладывать url
        }
        if (!$this->params["sort_order"]) {
            $this->params["sort_order"] = "DATE_INSERT";
        }
        if (!$this->params["sort_by"]) {
            $this->params["sort_by"] = "desc";
        }
        if (!$this->params["rules"] || $this->params["rules"] == "") {
            die("Не указаны правиля для формирования адреса");
        }
    }

    private function explodeUri($uri) {
        $requestUri = $uri;
        //удаляем первый и последний слеши
        if ($requestUri[0] == "/") {
            $requestUri = substr($requestUri, 1);
        }
        if ($requestUri[strlen($requestUri) - 1] == "/") {
            $requestUri = substr($requestUri, 0, strlen($requestUri) - 1);
        }
        return explode("/", $requestUri);
    }

    private function checkSection($section) {
        if ($this->sectionId !== null) {
            $result = SectionTable::getList(
                array(
                    "select" => array("CODE", "SECTION_ID", "BLOG_ID"),
                    "filter" => array("CODE" => $section, "ID" => $this->sectionId)
                )
            );
        } else {
            $result = SectionTable::getList(
                array(
                    "select" => array("CODE", "SECTION_ID", "BLOG_ID"),
                    "filter" => array("CODE" => $section)
                )
            );
        }
        if ($result->getCount() == 1) {
            $this->sectionId = $result->fetch()["SECTION_ID"];
            return true;
        }
        return false;    }

    private function checkElement($element) {
        $result = ElementsTable::getList(
            array(
                "select" => array("CODE", "SECTION_ID"),
                "filter" => array("CODE" => $element)
            )
        );
        if ($result->getCount() == 1) {
            $this->sectionId = $result->fetch()["SECTION_ID"];
            return true;
        }
        return false;
    }
}