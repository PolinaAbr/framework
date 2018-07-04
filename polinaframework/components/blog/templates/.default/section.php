<?php
use Polinaframework\Core\Application;

if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();

Application::getInstance()->includeComponent("blog.list", "",
    array(
        "blog_id" => $params["blog_id"],
        "sort_order" => $params["sort_order"],
        "sort_by" => $params["sort_by"],
        "section_code" => $result["section_code"]
    ));