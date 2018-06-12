<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
?>
<div class="header__search">
    <form action="<?echo $params['action']?>">
        <input type="text" name="<?echo $params['input_name']?>">
        <button type="submit"><?echo $params['button_text']?></button>
    </form>
</div>