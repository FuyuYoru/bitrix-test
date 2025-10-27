<?php

use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use Test\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CurrencyListComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        Loader::includeModule('test.currency');

        $nav = new PageNavigation("nav");
        $nav->allowAllRecords(true)->setPageSize(10)->initFromUri();

        $filter = [];
        if (!empty($_REQUEST['CODE'])) {
            $filter['=CODE'] = $_REQUEST['CODE'];
        }
        if (!empty($_REQUEST['DATE_FROM'])) {
            $filter['>=DATE'] = new \Bitrix\Main\Type\DateTime($_REQUEST['DATE_FROM']);
        }
        if (!empty($_REQUEST['DATE_TO'])) {
            $filter['<=DATE'] = new \Bitrix\Main\Type\DateTime($_REQUEST['DATE_TO']);
        }

        $res = CurrencyTable::getList([
            'select' => ['*'],
            'filter' => $filter,
            'order' => ['DATE' => 'DESC'],
            'count_total' => true,
            'limit' => $nav->getLimit(),
            'offset' => $nav->getOffset(),
        ]);

        $nav->setRecordCount($res->getCount());
        $this->arResult['ITEMS'] = $res->fetchAll();
        $this->arResult['NAV'] = $nav;
        $this->includeComponentTemplate();
    }
}
