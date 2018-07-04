<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Application;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\ElementsTable;
use Polinaframework\Core\Tables\Blog\SectionTable;

class BlogDetail extends Component{
    private $sectionId = null;

//    public function execute()
//    {
//        $items = ElementsTable::getList(
//            array(
//                "select" => array("*"),
//                "filter" => array(
//                    "CODE" => $this->params["element_code"],
//                    "ACTIVE" => "Y"
//                )
//            )
//        );
//        $this->result[] = $items->fetch();
//        $this->includeTemplate();
//    }

    public function execute()
    {
        $this->sectionId = $this->params["section_id"];
        $requestUri = $this->explodeUri();
        $isUriRight = false;
        array_pop($requestUri);
        $last = array_pop($requestUri);
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
            $items = ElementsTable::getList(
                array(
                    "select" => array("*"),
                    "filter" => array(
                        "CODE" => $this->params["element_code"],
                        "ACTIVE" => "Y"
                    )
                )
            );
            $this->result = $items->fetch();
            $this->includeTemplate();
        }
    }

    private function checkSection($section) {
        $items = SectionTable::getList(
            array(
                "select" => array("CODE", "SECTION_ID"),
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
}