<?php

use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use Test\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CurrencyListComponent extends CBitrixComponent
{
    protected function getFilter(): array
    {
        $filter = [];

        if (!empty($_REQUEST['CODE'])) {
            $filter['=CODE'] = $_REQUEST['CODE'];
        }

        if (!empty($_REQUEST['DATE_FROM'])) {
            try {
                $from = new \DateTime($_REQUEST['DATE_FROM'] . " 00:00:00");
                $filter['>=DATE'] = \Bitrix\Main\Type\DateTime::createFromPhp($from);
            } catch (\Exception $e) {}
        }

        if (!empty($_REQUEST['DATE_TO'])) {
            try {
                $to = new \DateTime($_REQUEST['DATE_TO'] . " 23:59:59");
                $filter['<=DATE'] = \Bitrix\Main\Type\DateTime::createFromPhp($to);
            } catch (\Exception $e) {}
        }

        if (!empty($_REQUEST['COURSE_FROM']) && is_numeric($_REQUEST['COURSE_FROM'])) {
            $filter['>=COURSE'] = (float)$_REQUEST['COURSE_FROM'];
        }

        if (!empty($_REQUEST['COURSE_TO']) && is_numeric($_REQUEST['COURSE_TO'])) {
            $filter['<=COURSE'] = (float)$_REQUEST['COURSE_TO'];
        }

        return $filter;
    }

    public function executeComponent(): void
    {
        Loader::includeModule('test.currency');

        // Определяем размер страницы (по умолчанию 10)
        $pageSize = (int)($_REQUEST['PAGE_SIZE'] ?? 10);
        if (!in_array($pageSize, [5, 10, 20])) {
            $pageSize = 10;
        }
        $currentPage = (int)($_REQUEST['PAGEN_1'] ?? 1);
        if ($currentPage < 1) $currentPage = 1;

        $nav = new PageNavigation("nav");
        $nav->allowAllRecords(true)
            ->setPageSize($pageSize)
            ->initFromUri();
        $nav->setCurrentPage($currentPage);

        // Фильтр
        $filter = $this->getFilter();

        // Получаем список
        $res = CurrencyTable::getList([
            'select' => ['*'],
            'filter' => $filter,
            'order' => ['DATE' => 'DESC'],
            'count_total' => true,
            'limit' => $nav->getLimit(),
            'offset' => $nav->getOffset(),
        ]);

        $nav->setRecordCount($res->getCount());

        // Результат
        $this->arResult = [
            'ITEMS' => $res->fetchAll(),
            'NAV' => $nav,
            'PAGE_SIZE' => $pageSize,
        ];

        $this->includeComponentTemplate();
    }
}
