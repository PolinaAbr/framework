<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
?>

<div class="left-content">
    <div class="main__menu">
        <?
        foreach ($result as $item) {
            if ($item["SECTION_ID"] == 0) {
                $link = "http://" . $_SERVER["SERVER_NAME"] . "/" . $_SESSION["blog_code"] . "/" . $item["CODE"] . "/";
                ?>
                <div class='menu__item'>
                    <div class='menu__item-wrap'>
                        <a class='item__link' href='<? echo $link ?>'><? echo $item["NAME"] ?></a>
                        <?
                        foreach ($result as $value) {
                            if ($value["SECTION_ID"] == $item["ID"]) {
                                ?>
                        <a class="submenu__btn" href="#"></a>
                    </div>
                    <div class="submenu">
                                <?
                                break;
                            }
                        }
                        foreach ($result as $value) {
                            if ($value["SECTION_ID"] == $item["ID"]) {
                                $sublink = $link . $value["CODE"] . "/";
                                ?>
                        <div class="submenu__item">
                            <a href="<? echo $sublink ?>"><?echo $value["NAME"] ?></a>
                        </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div>
                <?
            }
        }
        ?>
    </div>
    <div class="tags-cloud">
        Облако тегов
    </div>
</div>