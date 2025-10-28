document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('currency-filter');
    if (!form) return;

    const targetId = form.dataset.target;
    const listContainer = document.getElementById(targetId);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let currentPageSize = document.getElementById('page-size')?.value;
        const formData = new FormData(form);
        formData.append('PAGE_SIZE', currentPageSize);
        formData.append('PAGEN_1', 1);

        fetch('/local/components/test/currency.list/ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.text())
            .then(html => {
                if (listContainer) listContainer.innerHTML = html;
            })
            .catch(err => console.error('Ошибка фильтра AJAX:', err));
    });
});
