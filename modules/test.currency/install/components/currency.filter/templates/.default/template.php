<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="currency-filter" id="currency-filter">
    <form id="currency-filter-form">
        <div class="filter-main">
            <input
                    type="text"
                    name="CODE"
                    placeholder="Код валюты (например, USD)"
                    value="<?= htmlspecialcharsbx($_REQUEST['CODE'] ?? '') ?>"
                    class="filter-input"
            />

            <button type="button" id="toggle-filter" class="filter-btn">Фильтр ▾</button>
            <button type="submit" class="apply-btn">Применить</button>
            <button type="button" class="filter-btn" id="reset-filter">Сбросить</button>
        </div>

        <div class="filter-dropdown" id="filter-dropdown">
            <div class="filter-field">
                <label>Дата от:</label>
                <input type="date" name="DATE_FROM" value="<?= htmlspecialcharsbx($_REQUEST['DATE_FROM'] ?? '') ?>">
            </div>
            <div class="filter-field">
                <label>Дата до:</label>
                <input type="date" name="DATE_TO" value="<?= htmlspecialcharsbx($_REQUEST['DATE_TO'] ?? '') ?>">
            </div>
            <div class="filter-field">
                <label>Курс от:</label>
                <input type="number" step="0.0001" name="COURSE_FROM" value="<?= htmlspecialcharsbx($_REQUEST['COURSE_FROM'] ?? '') ?>">
            </div>
            <div class="filter-field">
                <label>Курс до:</label>
                <input type="number" step="0.0001" name="COURSE_TO" value="<?= htmlspecialcharsbx($_REQUEST['COURSE_TO'] ?? '') ?>">
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('currency-filter-form');
        const toggleBtn = document.getElementById('toggle-filter');
        const dropdown = document.getElementById('filter-dropdown');
        const resetBtn = document.getElementById('reset-filter');

        if (!form || !toggleBtn || !dropdown || !resetBtn) return;

        toggleBtn.addEventListener('click', () => {
            dropdown.classList.toggle('open');
        });

        form.addEventListener('submit', e => {
            e.preventDefault();
            const formData = new FormData(form);
            const data = {};

            formData.forEach((value, key) => {
                if (value.trim() !== '') {
                    data[key] = value.trim();
                }
            });
            document.dispatchEvent(new CustomEvent('CurrencyFilterChange', { detail: data }));
            dropdown.classList.remove('open');
        });

        resetBtn.addEventListener('click', () => {
            form.reset();
            dropdown.classList.remove('open');
            document.dispatchEvent(new CustomEvent('CurrencyFilterChange', { detail: {} }));
        });
    });
</script>

