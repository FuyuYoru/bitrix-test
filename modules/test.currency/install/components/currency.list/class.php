<?php

use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use Test\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CurrencyListComponent extends CBitrixComponent
{
    public function executeComponent(): void
    {
        Loader::includeModule('test.currency');

        $page = !empty($_REQUEST['PAGEN_1']) ? (int)$_REQUEST['PAGEN_1'] : 1;
        $pageSizeOptions = [5, 10, 20];
        $pageSize = (!empty($_REQUEST['PAGE_SIZE']) && in_array((int)$_REQUEST['PAGE_SIZE'], $pageSizeOptions))
            ? (int)$_REQUEST['PAGE_SIZE']
            : 10;

        $nav = new PageNavigation("nav");
        $nav->allowAllRecords(true)
            ->setPageSize($pageSize)
            ->setCurrentPage($page);

        $filter = [];
        if (!empty($_REQUEST['CODE'])) {
            $filter['=CODE'] = $_REQUEST['CODE'];
        }
        if (!empty($_REQUEST['DATE_FROM'])) {
            try {
                $phpDate = new \DateTime($_REQUEST['DATE_FROM'] . " 00:00:00");
                $filter['>=DATE'] = \Bitrix\Main\Type\DateTime::createFromPhp($phpDate);
            } catch (\Exception $e) {
            }
        }

        if (!empty($_REQUEST['DATE_TO'])) {
            try {
                $phpDate = new \DateTime($_REQUEST['DATE_TO'] . " 23:59:59");
                $filter['<=DATE'] = \Bitrix\Main\Type\DateTime::createFromPhp($phpDate);
            } catch (\Exception $e) {
            }
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
        $this->arResult['PAGE_SIZE'] = $pageSize;
        $this->arResult['PAGE_SIZE_OPTIONS'] = $pageSizeOptions;
        $this->includeComponentTemplate();
    }
}
