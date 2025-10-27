<?php

namespace Test\Currency;

use Bitrix\Main\Entity;

class CurrencyTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'test_currency';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\StringField('CODE', [
                'required' => true,
            ]),
            new Entity\DatetimeField('DATE', [
                'required' => true,
            ]),
            new Entity\FloatField('COURSE', [
                'required' => true,
            ]),
        ];
    }
}
