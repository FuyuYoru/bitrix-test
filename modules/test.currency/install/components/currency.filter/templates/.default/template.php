<form method="get">
    Код валюты: <input type="text" name="CODE" value="<?= htmlspecialchars($_GET['CODE'] ?? '') ?>"><br>
    Дата от: <input type="date" name="DATE_FROM" value="<?= htmlspecialchars($_GET['DATE_FROM'] ?? '') ?>">
    до: <input type="date" name="DATE_TO" value="<?= htmlspecialchars($_GET['DATE_TO'] ?? '') ?>"><br>
    <input type="submit" value="Фильтровать">
</form>
