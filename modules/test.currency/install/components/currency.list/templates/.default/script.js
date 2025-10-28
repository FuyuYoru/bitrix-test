document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('currency-filter');
    const listContainer = document.getElementById('currency-list');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/local/components/test/currency.list/ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(html => {
                listContainer.innerHTML = html;
            })
            .catch(err => {
                console.error('Ошибка при AJAX-запросе:', err);
            });
    });
});
