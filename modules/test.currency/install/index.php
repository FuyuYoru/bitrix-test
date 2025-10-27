<?php

use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;

class test_currency extends CModule
{
    public $MODULE_ID = 'test.currency';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public function __construct()
    {
        include __DIR__ . '/version.php';
        if (isset($arModuleVersion['VERSION'], $arModuleVersion['VERSION_DATE']))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $this->MODULE_NAME = 'Курсы валют';
        $this->MODULE_DESCRIPTION = 'Модуль для хранения и отображения курсов валют';
    }

    public function DoInstall()
    {
        global $USER;

        if (!$USER->IsAdmin())
        {
            return;
        }

        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        $this->InstallFiles();
    }
    public function DoUninstall()
    {
        global $USER;

        if (!$USER->IsAdmin())
        {
            return;
        }

        $this->UnInstallFiles();
        $this->UnInstallDB();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallDB(): void
    {
        $connection = Application::getConnection();
        $sql = file_get_contents(__DIR__ . '/db/mysql/install.sql');
        $connection->executeSqlBatch($sql);
    }

    public function UnInstallDB(): void
    {
        $connection = Application::getConnection();
        $sql = file_get_contents(__DIR__ . '/db/mysql/uninstall.sql');
        $connection->executeSqlBatch($sql);
    }

    public function InstallFiles(): void
    {
        $src = $_SERVER['DOCUMENT_ROOT'] . '/local/modules/test.currency/install/components';
        $dst = $_SERVER['DOCUMENT_ROOT'] . '/local/components/test';

        CopyDirFiles($src, $dst, true, true);
    }

    public function UnInstallFiles(): true
    {
        DeleteDirFilesEx('/local/components/test');
        return true;
    }
}
