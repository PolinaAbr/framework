<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\ElementsTable;

class BlogDetail extends Component{

    public function execute()
    {
        $items = ElementsTable::getList(
            array(
                "select" => array("*"),
                "filter" => array(
                    "ID" => $this->params["element_id"],
                    "ACTIVE" => "Y"
                )
            )
        );
        $this->result[] = $items->fetch();
        $this->includeTemplate();
    }

}