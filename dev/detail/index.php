<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/header.php");
$app = \Polinaframework\Core\Application::getInstance();
$app->setProperty("title", "База знаний на PolinaFramework");
$app->setProperty("wrapper-class", "section-wrapper");
$app->includeComponent("blog.detail");
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/footer.php");
?>