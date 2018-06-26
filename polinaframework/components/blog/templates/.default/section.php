<?php
use Polinaframework\Core\Application;

Application::getInstance()->includeComponent("blog.list", "",
    array(
        "blog_id" => $params["blog_id"],
        "sort_order" => $params["sort_order"],
        "sort_by" => $params["sort_by"],
        "section_code" => $result["section_code"],
        "section_id" => $result["section_id"]
    ));