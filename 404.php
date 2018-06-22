<?php
define("ERROR_PAGE_404", true);
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/header.php");
$app = \Polinaframework\Core\Application::getInstance();
$app->setProperty("title", "База знаний на PolinaFramework");
$app->isPage("");
?>
<h1>Неверный адрес страницы</h1>
<?
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/footer.php");
?>