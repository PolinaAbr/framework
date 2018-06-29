<?php
use Polinaframework\Core\Application;

if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();

Application::getInstance()->includeComponent("blog.detail", "",
    array(
        "blog_id" => $params["blog_id"],
        "sort_order" => $params["sort_order"],
        "sort_by" => $params["sort_by"],
        "element_code" => $result["element_code"]
    ));