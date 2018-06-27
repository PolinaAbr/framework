<?php
use Polinaframework\Core\Application;

Application::getInstance()->includeComponent("blog.detail", "",
    array(
        "blog_id" => $params["blog_id"],
        "sort_order" => $params["sort_order"],
        "sort_by" => $params["sort_by"],
        "element_code" => $result["element_code"],
        "element_id" => $result["element_id"]
    ));