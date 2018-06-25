<?php

namespace Polinaframework\Components;


use Polinaframework\Core\Component;

class Blog extends Component {

    public function execute()
    {
        if ($pos = strpos($_SERVER["REQUEST_URI"], "?")) {
            $requestUri = substr($_SERVER["REQUEST_URI"], 1, $pos);
            $requestParams = substr($_SERVER["REQUEST_URI"], $pos, strlen($_SERVER["REQUEST_URI"]));
        } else {
            $requestUri = substr($_SERVER["REQUEST_URI"], 1, strlen($_SERVER["REQUEST_URI"]));
        }
        if ($pos = strpos($requestUri, "/")) {
            $section = substr($requestUri, 0, $pos);
            
        } else {
            $section = $requestUri;
        }
        echo $section;

        //параметры
        //id блога
        //sort
        //filtername
        //rule массив
    }

}