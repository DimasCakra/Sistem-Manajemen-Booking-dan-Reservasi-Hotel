document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const tableBody = document.querySelector('tbody');

    // Edit Modal Fields
    const editForm = document.getElementById('editForm');
    const editNameInput = document.getElementById('editName');
    const editEmailInput = document.getElementById('editEmail');
    const editNoHpInput = document.getElementById('editNoHp');

    // Delete Modal Fields
    const deleteForm = document.getElementById('deleteForm');
    const deleteNameLabel = document.getElementById('deleteNameLabel');

    // Search & Filter
    const searchInput = document.getElementById('searchResepsionis');
    const filterSelect = document.getElementById('filterUrutan');
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
            const targetModal = button.closest('#createModal') || button.closest('#editModal') || button.closest('#deleteModal');
            if (targetModal) closeModal(targetModal);
        });
    });

    if (tableBody) {
        tableBody.addEventListener('click', event => {
            const editBtn = event.target.closest('.btn-edit');
            const deleteBtn = event.target.closest('.btn-delete');

            if (editBtn) {
                const id = editBtn.dataset.id;
                const name = editBtn.dataset.name;
                const email = editBtn.dataset.email;
                const nohp = editBtn.dataset.nohp;

                if (editForm) {
                    editForm.action = `/admin/resepsionis/${id}`;
                    editNameInput.value = name;
                    editEmailInput.value = email;
                    editNoHpInput.value = nohp === 'null' || !nohp ? '' : nohp;
                    openModal(editModal);
                }
            }

            if (deleteBtn) {
                const id = deleteBtn.dataset.id;
                const name = deleteBtn.dataset.name;

                if (deleteForm && deleteNameLabel) {
                    deleteForm.action = `/admin/resepsionis/${id}`;
                    deleteNameLabel.textContent = name;
                    openModal(deleteModal);
                }
            }
        });
    }

    // LOGIKA SEARCH & FILTER REAL-TIME
    function filterAndSortTable() {
        const query = searchInput.value.toLowerCase().trim();
        const sortOrder = filterSelect.value;
        const rows = Array.from(tableBody.querySelectorAll('.resepsionis-row'));

        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name;
            if (name.includes(query)) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        if (visibleCount === 0 && rows.length > 0) {
            noResultRow.classList.remove('hidden');
        } else {
            noResultRow.classList.add('hidden');
        }

        rows.sort((rowA, rowB) => {
            const nameA = rowA.querySelector('.name-label').textContent.toLowerCase();
            const nameB = rowB.querySelector('.name-label').textContent.toLowerCase();
            return sortOrder === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
        });

        rows.forEach(row => {
            if (row.id !== 'noResultRow' && row.id !== 'emptyRow') {
                tableBody.appendChild(row);
            }
        });
    }

    if (searchInput && filterSelect) {
        searchInput.addEventListener('input', filterAndSortTable);
        filterSelect.addEventListener('change', filterAndSortTable);
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            [createModal, editModal, deleteModal].forEach(modal => {
                if (modal && !modal.classList.contains('hidden')) closeModal(modal);
            });
        }
    });
});
