document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const detailModal = document.getElementById('detailModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const typeTableBody = document.getElementById('typeTableBody');
    const detailModalTitle = document.getElementById('detailModalTitle');
    const detailModalSubtitle = document.getElementById('detailModalSubtitle');
    const editSaveButton = document.getElementById('editSaveButton');
    const detailForm = document.getElementById('detailModalForm');

    let currentMode = 'view';
    let currentRow = null;

    const modalFields = {
        name: document.getElementById('detailTypeName'),
        code: document.getElementById('detailTypeCode'),
        price: document.getElementById('detailTypePrice'),
        description: document.getElementById('detailTypeDescription'),
        imageInput: document.getElementById('detailTypeImageInput'),
        imageContainer: document.getElementById('detailTypeImageContainer'),
    };

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
        if (modal === detailModal) {
            setModalMode('view');
        }
    }

    function setModalMode(mode) {
        currentMode = mode;
        const isEditable = mode === 'edit';
        detailModalTitle.textContent = mode === 'edit' ? 'Edit Tipe Kamar' : 'Detail Tipe Kamar';
        detailModalSubtitle.textContent = mode === 'edit' ? 'Perbarui data tipe kamar kemudian klik Simpan Perubahan.' : 'Lihat detail tipe kamar.';
        editSaveButton.textContent = mode === 'edit' ? 'Simpan Perubahan' : 'Edit Tipe';

        modalFields.name.readOnly = !isEditable;
        modalFields.code.readOnly = !isEditable;
        modalFields.price.readOnly = !isEditable;
        modalFields.description.readOnly = !isEditable;
        modalFields.imageInput.disabled = !isEditable;

        if (isEditable) {
            editSaveButton.classList.remove('bg-blue-600');
            editSaveButton.classList.add('bg-forest-700');
        } else {
            editSaveButton.classList.remove('bg-forest-700');
            editSaveButton.classList.add('bg-blue-600');
        }
    }

    function populateDetailModal(row) {
        modalFields.name.value = row.dataset.typeName || '';
        modalFields.code.value = row.dataset.typeCode || '';
        modalFields.price.value = row.dataset.typePrice || '';
        modalFields.description.value = row.dataset.typeDescription || '';

        if (modalFields.imageContainer) {
            modalFields.imageContainer.innerHTML = '';
            const images = JSON.parse(row.dataset.typeImages || '[]');
            if (images.length > 0) {
                images.forEach((src) => {
                    const img = document.createElement('img');
                    img.src = src;
                    img.alt = 'Foto Tipe Kamar';
                    img.className = 'w-full h-28 object-cover rounded-xl shadow-sm border border-white';
                    modalFields.imageContainer.appendChild(img);
                });
            } else {
                modalFields.imageContainer.innerHTML = '<p class="col-span-full text-center text-xs text-gray-400 py-4">Tidak ada foto</p>';
            }
        }

        if (detailForm) {
            detailForm.action = row.dataset.typeAction || '';
        }

        if (modalFields.imageInput) {
            modalFields.imageInput.value = '';
        }
    }

    function handleViewClick(event) {
        const row = event.target.closest('tr');
        if (!row) return;
        currentRow = row;
        populateDetailModal(row);
        setModalMode('view');
        openModal(detailModal);
    }

    function handleEditClick(event) {
        const row = event.target.closest('tr');
        if (!row) return;
        currentRow = row;
        populateDetailModal(row);
        setModalMode('edit');
        openModal(detailModal);
    }

    function handleDeleteClick(event) {
        const button = event.target.closest('button');
        const form = button ? button.closest('form') : null;
        if (!form) return;
        const row = form.closest('tr');
        const typeName = row ? row.dataset.typeName || 'tipe kamar ini' : 'tipe kamar ini';
        const confirmed = confirm(`Hapus ${typeName}? Tindakan ini tidak dapat dikembalikan.`);
        if (confirmed) {
            form.submit();
        }
    }

    if (openCreateModalButton) {
        openCreateModalButton.addEventListener('click', () => openModal(createModal));
    }

    modalCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetModal = button.closest('#createModal') || button.closest('#detailModal');
            if (targetModal) closeModal(targetModal);
        });
    });

    if (typeTableBody) {
        typeTableBody.addEventListener('click', event => {
            if (event.target.closest('.btn-view')) {
                handleViewClick(event);
            }
            if (event.target.closest('.btn-edit')) {
                handleEditClick(event);
            }
            if (event.target.closest('.btn-delete')) {
                handleDeleteClick(event);
            }
        });
    }

    if (editSaveButton) {
        editSaveButton.addEventListener('click', () => {
            if (currentMode === 'view') {
                setModalMode('edit');
                return;
            }
            if (detailForm) {
                detailForm.submit();
            }
        });
    }

    // Auto-convert kode_tipe to uppercase while typing
    const createKodeInput = createModal.querySelector('input[name="kode_tipe"]');
    if (createKodeInput) {
        createKodeInput.addEventListener('input', (e) => {
            e.target.value = e.target.value.toUpperCase();
        });
    }

    const detailKodeInput = modalFields.code;
    if (detailKodeInput) {
        detailKodeInput.addEventListener('input', (e) => {
            e.target.value = e.target.value.toUpperCase();
        });
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (createModal && !createModal.classList.contains('hidden')) closeModal(createModal);
            if (detailModal && !detailModal.classList.contains('hidden')) closeModal(detailModal);
        }
    });
});
