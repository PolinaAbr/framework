<?php
use Polinaframework\Core\Pager;
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
$app = \Polinaframework\Core\Application::getInstance();
$path = $app->getTemplatePath(false);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <? $app->setProperty("title", "База знаний");?>
    <title><? $app->showProperty("title")?></title>
    <link rel="shortcut icon" href=<? echo $path . "/img/favicon.ico"?> type="image/x-icon">
    <meta name="format-detection" content="telephone=no"><!-- отключение преобразования телефонов в ссылке на IOS -->
    <meta http-equiv="x-rim-auto-match" content="none"><!-- отключение преобразования телефонов в ссылке на BlackBerry -->
    <? $app->showHead();
    $app->addHeadString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
    $app->addCss($path . "/css/bootstrap.min.css");
    $app->addCss($path . "/libs/fancybox/jquery.fancybox.min.css");
    $app->addCss($path . "/libs/highlightjs/darkula.css");
    $app->addCss($path . "/css/style.css");
    $app->addScript($path . "/libs/jquery-3.3.1.min.js");
    $app->addScript($path . "/libs/fancybox/jquery.fancybox.min.js");
    $app->addScript($path . "/js/main.js");
    ?>
</head>

<body>
    <div class="wrapper <? $app->showProperty("wrapper-class") ?>">

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
        <div class="main">
            <div class="container-fluid">
                <div class="workarea">
                    <? if (!$app->isMain()) :  ?>
                    <div class="left-content">
                        <div class="main__menu">
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Готовые решения</a>
                                    <a class="submenu__btn" href="#"></a>
                                </div>
                                <div class="submenu">
                                    <div class="submenu__item">
                                        <a href="#">
                                            Подпункт1
                                        </a>
                                    </div>
                                    <div class="submenu__item">
                                        <a href="#">
                                            Подпункт2
                                        </a>
                                    </div>
                                    <div class="submenu__item">
                                        <a href="#">
                                            Подпункт3
                                        </a>
                                    </div>
                                    <div class="submenu__item">
                                        <a href="#">
                                            Подпункт4
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Полезные советы</a>
                                </div>
                            </div>
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Особенности/баги</a>
                                </div>
                            </div>
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Сататьи</a>
                                </div>
                            </div>
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Для новичков</a>
                                </div>
                            </div>
                            <div class="menu__item">
                                <div class="menu__item-wrap">
                                    <a class="item__link" href="#">Помойка</a>
                                </div>
                            </div>
                        </div>
                        <div class="tags-cloud">
                            Облако тегов
                        </div>
                    </div>
                    <? endif ?>
                    <div class="right-content">
                        <div class="breadcrumbs">
                            <a href="#">Разработка</a> >
                            <a href="#">Готовые рашения</a> >
                            <a href="#">Подпункт1</a> >
                            <span>Заголовок</span>
                        </div>
                        <h1>Заголовок</h1>