<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/header.php");
$app = \Polinaframework\Core\Application::getInstance();
$app->setProperty("title", "База знаний на PolinaFramework");
$app->setProperty("wrapper-class", "section-wrapper");
?>

<div class="list">

    <?
    //параметры
    //id блога
    //sort
    //filtername
    //rule массив
    $app->includeComponent("blog", "",
        array(
            "blog_id" => 1,
            "sort_order" => "DATE_INSERT",
            "sort_by" => "desc",
            "filtername" => "arrfilter",
            "rules" =>
                array(
                    "sections" => "",
                    "section" => "/dev/#SECTION_CODE#/",
                    "detail" => "/dev/#SECTION_CODE_PATH#/#ELEMENT_CODE#/"
                )
        )
    );
    ?>

</div>

<?
include ($_SERVER['DOCUMENT_ROOT'] . "/polinaframework/footer.php");
?>