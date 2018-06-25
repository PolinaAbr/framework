<?php
//на этот ссылается htaccess
//обработка правил из urlrewrite
//генерация 404

$arUrlRewrite = array();
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/urlrewrite.php')) {
    include($_SERVER['DOCUMENT_ROOT'] . '/urlrewrite.php');
}
$sortMap = array();
for ($i = 0; $i < count($arUrlRewrite); $i++) {
    $sortMap[$i] = strlen($arUrlRewrite[$i]["CONDITION"]);
}
arsort($sortMap);
$sortMap = array_keys($sortMap);

if ($pos = strpos($_SERVER["REQUEST_URI"], "?")) {
    $requestUri = substr($_SERVER["REQUEST_URI"], 0, $pos);
    $requestParams = substr($_SERVER["REQUEST_URI"], $pos, strlen($_SERVER["REQUEST_URI"]));
} else {
    $requestUri = $_SERVER["REQUEST_URI"];
}

$pageExist = false;
foreach ($sortMap as $index) {
    $rule = $arUrlRewrite[$index];
    if (preg_match($rule["CONDITION"], $requestUri)) {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $rule["PATH"])) {
            include($_SERVER["DOCUMENT_ROOT"] . $rule["PATH"]);
            $pageExist = true;
            break;
        }
    }
}
if (!$pageExist) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/404.php")) {
        include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    }
}