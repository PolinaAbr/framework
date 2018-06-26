<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
for ($i = 0; $i < count($result); $i++) {
?>

<div class="list__item">
    <div class="item__head">
        <a href="#"><? echo $result[$i]["NAME"] ?></a>
    </div>
    <div class="item__text">
        <? echo $result[$i]["PREVIEW_TEXT"] ?>
    </div>
    <div class="item__tags">
        <span>Теги:</span>
        <?
        $tags = explode(", ", $result[$i]["TAGS"]);
        for ($j = 0; $j < count($tags) - 1; $j++) {
        ?>
            <a href="#"><? echo $tags[$j] ?></a>,
        <?
        }
        ?>
        <a href="#"><? echo $tags[count($tags) - 1] ?></a>
    </div>
</div>

<?
}
?>