<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;

class BlogDetail extends Component{

    public function execute()
    {
        $result = \Polinaframework\Core\Tables\Blog\ElementsTable::getList(array("select" => array("DETAIL_TEXT")));
        while ($item = $result->fetch())
        {
            echo $item["DETAIL_TEXT"];
        }
        $this->includeTemplate();
    }

}