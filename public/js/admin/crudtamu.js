document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('deleteModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const deleteForm = document.getElementById('deleteForm');
    const deleteNameLabel = document.getElementById('deleteNameLabel');
    const tableBody = document.querySelector('tbody');
    const searchInput = document.getElementById('searchTamu');
    const filterSelect = document.getElementById('filterField');
    const noResultRow = document.getElementById('noResultRow');
    const searchForm = document.getElementById('searchFilterForm');

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

    modalCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetModal = button.closest('#deleteModal');
            if (targetModal) closeModal(targetModal);
        });
    });

    if (tableBody) {
        tableBody.addEventListener('click', event => {
            const deleteBtn = event.target.closest('.btn-delete');
            if (deleteBtn) {
                const id = deleteBtn.dataset.id;
                const name = deleteBtn.dataset.name;
                if (deleteForm && deleteNameLabel) {
                    deleteForm.action = `/admin/tamu/${id}`;
                    deleteNameLabel.textContent = name;
                    openModal(deleteModal);
                }
            }
        });
    }

    function submitFilterForm() {
        if (searchForm) searchForm.submit();
    }

    if (filterSelect) {
        filterSelect.addEventListener('change', submitFilterForm);
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (deleteModal && !deleteModal.classList.contains('hidden')) {
                closeModal(deleteModal);
            }
        }
    });

    // filterTable removed, handled server side
});
