<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
$path = Polinaframework\Core\Application::getInstance()->getTemplatePath(false);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href=<? echo $path . "/img/favicon.ico"?> type="image/x-icon">
    <meta name="format-detection" content="telephone=no"><!-- отключение преобразования телефонов в ссылке на IOS -->
    <meta http-equiv="x-rim-auto-match" content="none"><!-- отключение преобразования телефонов в ссылке на BlackBerry -->
    <link href=<? echo $path . "/css/bootstrap.min.css"?> rel="stylesheet" media="screen">
    <link href=<? echo $path . "/libs/fancybox/jquery.fancybox.min.css"?> rel="stylesheet" type="text/css">
    <link href=<? echo $path . "/libs/highlightjs/darkula.css"?> rel="stylesheet" type="text/css">
    <link href=<? echo $path . "/css/style.css"?> rel="stylesheet" type="text/css">
    <script src=<? echo $path . "/libs/jquery-3.3.1.min.js"?>></script>
    <script src=<? echo $path . "/libs/fancybox/jquery.fancybox.min.js"?>></script>
    <script src=<? echo $path . "/js/main.js"?>></script>
</head>

<body>
    <div class="wrapper main-wrapper">

        <div class="header">
            <div class="container-fluid">
                <div class="header__wrap">
                    <div class="logo">
                        <a href="#">
                            <img src=<? echo $path . "/img/logo_web-01.png"?>>
                        </a>
                    </div>
                    <div class="header__menu">
                        <a class="menu__item" href="#">Разработка</a>
                        <a class="menu__item" href="#">Верстка</a>
                        <a class="menu__item" href="#">Менеджмент</a>
                    </div>
                    <?
                    Polinaframework\Core\Application::getInstance()->includeComponent(
                        "search.input",
                        "",
                        array(
                            "action" => "/",
                            "input_name" => "q",
                            "button_text" => "Поиск"
                        )
                    );
                    ?>
                </div>
            </div>
        </div>