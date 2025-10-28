document.addEventListener('DOMContentLoaded', function () {
    const listContainer = document.getElementById('currency-list');

    if (!listContainer) return;

    let currentPageSize = 10;

    function bindPageSize(select) {
        select.addEventListener('change', function () {
            currentPageSize = this.value;
            updateList({ PAGEN_1: 1 });
        });
    }

    function updateList(extraData = {}) {
        const formData = new FormData();
        formData.append('PAGE_SIZE', currentPageSize);

        for (let key in extraData) {
            formData.append(key, extraData[key]);
        }

        fetch('/local/components/test/currency.list/ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.text())
            .then(html => {
                listContainer.innerHTML = html;

                // После ререндеринга снова ищем select и вешаем обработчик
                const pageSizeControl = listContainer.querySelector('#page-size');
                if (pageSizeControl) bindPageSize(pageSizeControl);
            })
            .catch(err => console.error('Ошибка AJAX:', err));
    }

    // Пагинация
    listContainer.addEventListener('click', function (e) {
        const link = e.target.closest('.bx-pagination-link');
        if (!link) return;

        e.preventDefault();
        const page = link.dataset.page;
        if (!page) return;

        updateList({ PAGEN_1: page });
    });

    // Изначально привязываем select
    const initialPageSize = listContainer.querySelector('#page-size');
    if (initialPageSize) bindPageSize(initialPageSize);
});
