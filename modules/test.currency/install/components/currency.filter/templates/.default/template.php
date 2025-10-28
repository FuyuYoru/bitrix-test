<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<form id="currency-filter" class="currency-filter" data-target="currency-list">
    <input type="text" name="CODE" placeholder="Код валюты">
    <input type="date" name="DATE_FROM" placeholder="С даты">
    <input type="date" name="DATE_TO" placeholder="По дату">
    <button type="submit">Фильтр</button>
</form>

<script src="<?= $templateFolder ?>/script.js"></script>
