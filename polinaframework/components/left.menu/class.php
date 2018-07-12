<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;
use Polinaframework\Core\Tables\Blog\SectionTable;

class LeftMenu extends Component {

    public function execute()
    {
        $items = SectionTable::getList(array(
            "select" => array(
                "ID",
                "NAME",
                "CODE",
                "SECTION_ID",
            ),
            "filter" => array(
                "BLOG_ID" => $_SESSION["blog_id"]
            )
        ));
        while ($item = $items->fetch()) {
            $this->result[] = $item;
        }
        $this->includeTemplate();
    }

}
?>