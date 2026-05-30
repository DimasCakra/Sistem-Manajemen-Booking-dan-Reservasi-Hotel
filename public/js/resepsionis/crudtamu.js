document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const tableBody = document.querySelector('tbody');
    const searchInput = document.getElementById('searchTamu');
    const filterSelect = document.getElementById('filterField');
    const noResultRow = document.getElementById('noResultRow');

    function openModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    if (openCreateModalButton && createModal) {
        openCreateModalButton.addEventListener('click', () => openModal(createModal));
    }

    modalCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetModal = button.closest('#createModal');
            if (targetModal) closeModal(targetModal);
        });
    });

    function filterTable() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const filterField = filterSelect ? filterSelect.value : 'nama';
        const rows = tableBody ? Array.from(tableBody.querySelectorAll('.tamu-row')) : [];

        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name || '';
            const email = row.dataset.email || '';
            const target = filterField === 'email' ? email : name;

            if (target.includes(query)) {
                row.classList.remove('hidden');
                visibleCount += 1;
            } else {
                row.classList.add('hidden');
            }
        });

        if (noResultRow) {
            if (visibleCount === 0 && rows.length > 0) {
                noResultRow.classList.remove('hidden');
            } else {
                noResultRow.classList.add('hidden');
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }

    if (filterSelect) {
        filterSelect.addEventListener('change', filterTable);
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (createModal && !createModal.classList.contains('hidden')) {
                closeModal(createModal);
            }
        }
    });

    filterTable();
});
