<?php
global $APPLICATION;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
    "test:currency.list",
    "",
    [
        "AJAX" => "Y",
    ],
    false
);
