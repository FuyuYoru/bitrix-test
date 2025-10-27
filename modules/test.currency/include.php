<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    "test.currency",
    [
        "Test\\Currency\\CurrencyTable" => "lib/currencytable.php",
    ]
);