<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
?>
<div class="breadcrumbs">
    <?
    for ($i = 0; $i < count($result) - 1; $i++) {
        ?>
        <a href="<? echo  $result[$i]["href"] ?>"><? echo $result[$i]["NAME"] ?></a> >
        <?
    }
    ?>
    <span><? echo $result[count($result) - 1]["NAME"] ?></span>
</div>

