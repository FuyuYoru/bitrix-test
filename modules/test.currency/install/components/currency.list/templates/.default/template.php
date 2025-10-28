<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if ($arParams["AJAX"] != "Y") : ?>
<div id="currency-component" class="currency-component">
    <form id="currency-filter" class="currency-filter">
        <input type="text" name="CODE" placeholder="Код валюты">
        <input type="date" name="DATE_FROM" placeholder="С даты">
        <input type="date" name="DATE_TO" placeholder="По дату">
        <button type="submit">Фильтр</button>
    </form>

    <div id="currency-list">
        <?php endif; ?>

        <table border="1" cellspacing="0" cellpadding="4">
            <thead>
            <tr>
                <th>Код</th>
                <th>Дата</th>
                <th>Курс</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arResult["ITEMS"] as $item): ?>
                <tr>
                    <td><?=htmlspecialcharsbx($item["CODE"])?></td>
                    <td><?=htmlspecialcharsbx($item["DATE"])?></td>
                    <td><?=htmlspecialcharsbx($item["COURSE"])?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

<!--        --><?php //=$arResult["NAV"]->getNavPrint("Страницы");?>

        <?php if ($arParams["AJAX"] != "Y") : ?>
    </div>
</div>

    <script src="<?=$templateFolder?>/script.js"></script>
<?php endif; ?>
