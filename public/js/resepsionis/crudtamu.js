document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
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

    if (openCreateModalButton && createModal) {
        openCreateModalButton.addEventListener('click', () => openModal(createModal));
    }

    modalCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetModal = button.closest('#createModal');
            if (targetModal) closeModal(targetModal);
        });
    });

    function submitFilterForm() {
        if (searchForm) searchForm.submit();
    }

    if (filterSelect) {
        filterSelect.addEventListener('change', submitFilterForm);
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (createModal && !createModal.classList.contains('hidden')) {
                closeModal(createModal);
            }
        }
    });

    // filterTable removed, handled server side
});
