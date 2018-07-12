<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Application;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\BlogTable;
use Polinaframework\Core\Tables\Blog\ElementsTable;
use Polinaframework\Core\Tables\Blog\SectionTable;

class BlogList extends Component{
    private $sectionId = null;

    public function execute() {
        $requestUri = $this->explodeUri();
        $isUriRight = false;
        $items = SectionTable::getList(
            array(
                "select" => array("ID", "SECTION_ID"),
                "filter" => array(
                    "CODE" => $this->params["section_code"],
                    "ACTIVE" => "Y")
            )
        );
        if ($items->getCount() == 1) {
            $item = $items->fetch();
            $this->sectionId = $item["SECTION_ID"];
            $this->params["section_id"] = $item["ID"];
            array_pop($requestUri);
            $last = array_pop($requestUri);
            if (count($requestUri) == 0 && $this->sectionId == 0) {
                $isUriRight = true;
            } elseif (count($requestUri) == 0 && $this->sectionId != 0) {
                Application::getInstance()->set404();
            }
            while (count($requestUri) > 0) {
                $section = $this->checkSection($last);
                if (!$section || (count($requestUri) == 1 && $this->sectionId != 0)) {
                    Application::getInstance()->set404();
                } else {
                    $isUriRight = true;
                }
                $last = array_pop($requestUri);
            }
            if ($isUriRight) {
                $sections = array();
                if ($sectionsList = $this->params["section_id"]) {
                    do {
                        $items = SectionTable::getList(
                            array(
                                "select" => array("ID"),
                                "filter" => array(
                                    "SECTION_ID" => $sectionsList,
                                    "ACTIVE" => "Y")
                            )
                        );
                        if ($count = $items->getCount() > 0) {
                            while ($item = $items->fetch()) {
                                $sections[] = $item["ID"];
                            }
                            $sectionsList = implode(", ", $sections);
                            $this->params["section_id"] .= ", " . implode(", ", $sections);
                            unset($sections);
                        }
                    } while ($count > 0);
                    $items = ElementsTable::getList(
                        array(
                            "select" => array("*"),
                            "filter" => array(
                                "BLOG_ID" => $this->params["blog_id"],
                                "SECTION_ID" => $this->params["section_id"],
                                "ACTIVE" => "Y"),
                            "order" => array($this->params["sort_order"] => $this->params["sort_by"])
                        )
                    );
                } else {
                    $items = ElementsTable::getList(
                        array(
                            "select" => array("*"),
                            "filter" => array(
                                "BLOG_ID" => $this->params["blog_id"],
                                "ACTIVE" => "Y"),
                            "order" => array($this->params["sort_order"] => $this->params["sort_by"])
                        )
                    );
                }
                while($item = $items->fetch()) {
                    $this->result[] = $item;
                }
                $this->setElementsUri();
                $this->includeTemplate();
            }
        } else {
            $last = array_pop($requestUri);
            $items = BlogTable::getList(
                array(
                    "select" => array("ID"),
                    "filter" => array(
                        "ID" => $this->params["blog_id"],
                        "CODE" => $last,
                        "ACTIVE" => "Y")
                )
            );
            if ($items->getCount() == 1) {
                $items = ElementsTable::getList(
                    array(
                        "select" => array("*"),
                        "filter" => array(
                            "BLOG_ID" => $this->params["blog_id"],
                            "ACTIVE" => "Y"),
                        "order" => array($this->params["sort_order"] => $this->params["sort_by"])
                    )
                );
                while($item = $items->fetch()) {
                    $this->result[] = $item;
                }
                $this->setElementsUri();
                $this->includeTemplate();
            } else {
                Application::getInstance()->set404();
            }
        }
    }

    private function checkSection($section) {
        $items = SectionTable::getList(
            array(
                "select" => array("CODE", "SECTION_ID", "BLOG_ID"),
                "filter" => array("CODE" => $section, "ID" => $this->sectionId)
            )
        );
        if ($items->getCount() == 1) {
            $item = $items->fetch();
            $this->sectionId = $item["SECTION_ID"];
            return true;
        }
        return false;
    }

    private function setElementsUri() {
        for ($i = 0; $i < count($this->result); $i++) {
            $items = SectionTable::getList(array(
                "select" => array("CODE", "SECTION_ID"),
                "filter" => array("ID" => $this->result[$i]["SECTION_ID"]),
            ));
            $items = $items->fetch();
            $elementUri = $items["CODE"] . "/" . $this->result[$i]["CODE"];
            while ($items["SECTION_ID"] != 0) {
                $items = SectionTable::getList(array(
                    "select" => array("CODE", "SECTION_ID"),
                    "filter" => array("ID" => $items["SECTION_ID"]),
                ));
                $items = $items->fetch();
                $elementUri = $items["CODE"] . "/" . $elementUri;
            }
            $items = BlogTable::getList(
                array(
                    "select" => array("CODE"),
                    "filter" => array("ID" => $this->result[$i]["BLOG_ID"])
                )
            );
            $items = $items->fetch();
            $elementUri = "http://" . $_SERVER["SERVER_NAME"] . "/" . $items["CODE"] . "/" . $elementUri;
            $this->result[$i]["URI"] = $elementUri;
        }
    }
}