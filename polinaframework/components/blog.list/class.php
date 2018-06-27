<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\ElementsTable;

class BlogList extends Component{

    public function execute() {
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
        while($item = $items->fetch()) {
            $this->result[] = $item;
        }
        $this->includeTemplate();
    }

}