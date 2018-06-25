<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;

class TopMenu extends Component {

    public function execute()
    {
        $result = \Polinaframework\Core\Tables\Blog\BlogTable::getList(array("select" => array("ID", "CODE", "NAME")));
        while ($item = $result->fetch()) {
            echo "<a class='menu__item' href='http://framework/" . $item['CODE'] . "/'>" . $item['NAME'] . "</a>";
        }
    }

}