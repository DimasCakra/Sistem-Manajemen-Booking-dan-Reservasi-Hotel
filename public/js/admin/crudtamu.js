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
    const editWhatsappInput = document.getElementById('editWhatsapp');
    const editUsernameInput = document.getElementById('editUsername');
    
    // Delete Modal Fields
    const deleteForm = document.getElementById('deleteForm');
    const deleteNameLabel = document.getElementById('deleteNameLabel');

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
                const whatsapp = editBtn.dataset.whatsapp;
                const username = editBtn.dataset.username;

                if (editForm) {
                    editForm.action = `/admin/tamu/${id}`;
                    if (editNameInput) editNameInput.value = name;
                    if (editEmailInput) editEmailInput.value = email;
                    if (editWhatsappInput) editWhatsappInput.value = whatsapp;
                    if (editUsernameInput) editUsernameInput.value = username;
                    openModal(editModal);
                }
            }

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

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            [createModal, editModal, deleteModal].forEach(modal => {
                if (modal && !modal.classList.contains('hidden')) {
                    closeModal(modal);
                }
            });
        }
    });
});
