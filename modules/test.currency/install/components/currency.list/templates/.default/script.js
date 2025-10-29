document.addEventListener('DOMContentLoaded', () => {
    const listContainer = document.getElementById('currency-list');
    if (!listContainer) return;

    class CurrencyList {
        constructor(container) {
            this.container = container;
            this.pageSize = container.querySelector('#page-size')?.value || 10;
            this.currentFilter = {};

            document.addEventListener('CurrencyFilterChange', e => this.onFilterChange(e.detail));
            document.addEventListener('CurrencyPageChange', e => this.onPageChange(e.detail));
            document.addEventListener('CurrencyPageSizeChange', e => this.onPageSizeChange(e.detail));

            this.container.addEventListener('click', e => this.handlePaginationClick(e));
            this.container.addEventListener('change', e => this.handlePageSizeChange(e));
        }

        handlePaginationClick(e) {
            const link = e.target.closest('.bx-pagination-link');
            if (!link) return;
            e.preventDefault();
            document.dispatchEvent(new CustomEvent('CurrencyPageChange', {
                detail: { page: link.dataset.page }
            }));
        }

        handlePageSizeChange(e) {
            if (e.target.id !== 'page-size') return;
            document.dispatchEvent(new CustomEvent('CurrencyPageSizeChange', {
                detail: { size: e.target.value }
            }));
        }

        onFilterChange(filterData) {
            this.currentFilter = { ...filterData };
            this.pageSize = 10;
            this.updateList({
                ...this.currentFilter,
                PAGE_SIZE: this.pageSize,
                PAGEN_1: 1
            });
        }

        onPageChange({ page }) {
            this.updateList({ ...this.currentFilter,PAGE_SIZE: this.pageSize, PAGEN_1: page });
        }

        onPageSizeChange({ size }) {
            this.pageSize = size;
            this.updateList({ ...this.currentFilter,PAGE_SIZE: size, PAGEN_1: 1 });
        }

        updateList(extraData = {}) {
            const formData = new FormData();
            for (const [key, value] of Object.entries(extraData)) {
                formData.append(key, value);
            }

            fetch('/local/components/test/currency.list/ajax.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.text())
                .then(html => {
                    this.container.innerHTML = html;
                })
                .catch(err => console.error('Ошибка AJAX:', err));
        }
    }

    new CurrencyList(listContainer);
});
