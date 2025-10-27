<?php

$arModuleVersion = [];
include __DIR__ . '/install/version.php';

$arModuleDescription = [
    'MODULE_ID' => 'test.currency',
    'MODULE_NAME' => 'Курсы валют',
    'MODULE_DESCRIPTION' => 'Модуль для хранения и отображения курсов валют',
    'PARTNER_NAME' => 'Test',
    'VERSION' => $arModuleVersion['VERSION'],
    'VERSION_DATE' => $arModuleVersion['VERSION_DATE'],
];