<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/header.php");
$app = \Polinaframework\Core\Application::getInstance();
$app->setProperty("title", "База знаний на PolinaFramework");
$app->setProperty("wrapper-class", "section-wrapper");
?>

<div class="list">
    <? $app->includeComponent("blog"); ?>
</div>

<?
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/footer.php");
?>