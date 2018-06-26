<?php
//правила
//https://dev.1c-bitrix.ru/api_help/main/general/urlrewrite.php
$arUrlRewrite=array (
    0 =>
        array (
            'CONDITION' => '#^/development/#',
            'RULE' => '',
            'PATH' => '/dev/index.php',
        ),
    1 =>
        array (
            'CONDITION' => '#^/front/#',
            'RULE' => '',
            'PATH' => '/front/index.php',
        ),
    2 =>
        array (
            'CONDITION' => '#^/management/#',
            'RULE' => '',
            'PATH' => '/management/index.php',
        ),
);