<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div id="currency-list">
    <div class="currency-controls">
        <label for="page-size">Показывать по: </label>
        <select id="page-size" name="PAGE_SIZE">
            <?php foreach ([5, 10, 20] as $size): ?>
                <option value="<?= $size ?>" <?= $size == $arResult['PAGE_SIZE'] ? 'selected' : '' ?>><?= $size ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <table class="currency-table">
        <thead>
        <tr>
            <th>Код</th>
            <th>Дата</th>
            <th>Курс</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($arResult["ITEMS"])): ?>
            <?php foreach ($arResult["ITEMS"] as $item): ?>
                <tr>
                    <td><?=htmlspecialcharsbx($item["CODE"])?></td>
                    <td><?=htmlspecialcharsbx($item["DATE"])?></td>
                    <td><?=htmlspecialcharsbx($item["COURSE"])?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">Нет данных</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="currency-nav">
        <?php if ($arResult["NAV"]->getPageCount() > 1): ?>
            <?php for ($i = 1; $i <= $arResult["NAV"]->getPageCount(); $i++): ?>
                <?php if ($i == $arResult["NAV"]->getCurrentPage()): ?>
                    <span class="bx-pagination-current"><?= $i ?></span>
                <?php else: ?>
                    <a href="#" class="bx-pagination-link" data-page="<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</div>

<script src="<?= $templateFolder ?>/script.js"></script>
