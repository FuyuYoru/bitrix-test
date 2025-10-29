# Модуль "Курсы валют" для Bitrix

Модуль `test.currency` добавляет функционал работы с курсами валют в Bitrix.

---

## Состав проекта

- **Компонент `currency.filter`**  
  Форма фильтрации:
    - Код валюты
    - Дата от / до
    - Курс от / до

  Реализован как dropdown:
    - Кнопка **Применить** – отправка фильтра
    - Кнопка **Сбросить фильтр** – очистка полей

- **Компонент `currency.list`**  
  Таблица с курсами валют:
    - Пагинация
    - Выбор количества элементов на странице (5, 10, 20)

---

## Установка

1. В админке Bitrix:  
   **Маркетплейс → Установленные решения → "Курсы валют" → Установить**
2. Создать страницу и добавить следующий код:

```php
<?php global $APPLICATION;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?php $APPLICATION->IncludeComponent("test:currency.filter", "");?>
<?php $APPLICATION->IncludeComponent("test:currency.list", "");?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
```

3. Страница готова к использованию

## Используемые технологии

1. PHP 8.2
2. MySQL 8.4
3. Bitrix Framework