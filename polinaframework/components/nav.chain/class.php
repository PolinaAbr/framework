<?php

namespace Polinaframework\Components;
use Polinaframework\Core\Component;

class NavChain extends Component
{
    function execute()
    {
        $server = $_SERVER["SERVER_NAME"];
        $this->result[0]["NAME"] = "Главная";
        $link = "http://" . $server . "/";
        $this->result[0]["href"] = $link;
        $requestUri = $this->explodeUri();
        $i = 1;
        while (count($requestUri) > 0) {
            $first = array_shift($requestUri);
            $tables = array(
                "Polinaframework\Core\Tables\Blog\BlogTable",
                "Polinaframework\Core\Tables\Blog\SectionTable",
                "Polinaframework\Core\Tables\Blog\ElementsTable");
            for ($j = 0; $j < count($tables); $j++) {
                $items = $tables[$j]::getList(array(
                    "select" => array("NAME"),
                    "filter" => array("CODE" => $first),
                ));
                if ($items->getCount() == 1) {
                    $this->result[$i]["NAME"] = $items->fetch()["NAME"];
                    $link .= $first . "/";
                    $this->result[$i]["href"] = $link;
                    $i++;
                }
            }
        }
        $this->includeTemplate();
    }

}