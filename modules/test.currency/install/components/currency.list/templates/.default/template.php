<?php
/** @var array $arResult */

echo '<table border="1" cellpadding="5">';
echo '<tr><th>ID</th><th>Код</th><th>Дата</th><th>Курс</th></tr>';
foreach ($arResult['ITEMS'] as $item) {
    echo '<tr>';
    echo "<td>{$item['ID']}</td>";
    echo "<td>{$item['CODE']}</td>";
    echo "<td>{$item['DATE']->format('d.m.Y')}</td>";
    echo "<td>{$item['COURSE']}</td>";
    echo '</tr>';
}
echo '</table>';

echo $arResult['NAV']->getNavPrint('Навигация');
