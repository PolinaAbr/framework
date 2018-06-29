<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\ElementsTable;
use Polinaframework\Core\Tables\Blog\SectionTable;

class BlogList extends Component{

    public function execute() {
        $sections = array();
        $this->params["section_id"] = 3;
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
        $this->includeTemplate();
    }

}