document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const detailModal = document.getElementById('detailModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const roomTableBody = document.getElementById('roomTableBody');
    const detailModalTitle = document.getElementById('detailModalTitle');
    const detailModalSubtitle = document.getElementById('detailModalSubtitle');
    const editSaveButton = document.getElementById('editSaveButton');
    const detailForm = document.getElementById('detailModalForm');
    const searchForm = document.getElementById('searchFilterForm');
    const searchInput = document.getElementById('searchInput');
    const filterType = document.getElementById('filterType');
    const filterStatus = document.getElementById('filterStatus');

    let currentRow = null;
    let currentMode = 'view';
    let debounceTimer = null;

    const modalFields = {
        roomNumber: document.getElementById('detailRoomNumber'),
        roomType: document.getElementById('detailRoomType'), // Text input untuk tipe kamar
        price: document.getElementById('detailRoomPrice'),
        roomCode: document.getElementById('detailRoomCode'),
        status: document.getElementById('detailRoomStatus'),
        description: document.getElementById('detailRoomDescription'),
        image: document.getElementById('detailRoomImage')
    };

    // Filter Table Function Logic
    function filterTable() {
        if (!roomTableBody) return;

        const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
        const selectedType = filterType ? filterType.value : '';
        const selectedStatus = filterStatus ? filterStatus.value : '';
        const rows = roomTableBody.querySelectorAll('tr');

        rows.forEach(row => {
            const roomNumber = row.dataset.roomNumber || '';
            const roomType = row.dataset.roomType || '';
            const roomStatus = row.dataset.roomStatus || '';

            const matchSearch = roomNumber.toLowerCase().includes(searchQuery) || roomType.toLowerCase().includes(searchQuery);
            const matchType = selectedType === "" || roomType === selectedType;
            const matchStatus = selectedStatus === "" || roomStatus === selectedStatus;

            if (matchSearch && matchType && matchStatus) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (filterType) filterType.addEventListener('change', filterTable);
    if (filterStatus) filterStatus.addEventListener('change', filterTable);


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
        detailModalTitle.textContent = mode === 'edit' ? 'Edit Kamar' : 'Detail Kamar';
        detailModalSubtitle.textContent = mode === 'edit' ? 'Perbarui data kamar dan tekan Simpan Perubahan.' : 'Lihat detail kamar dengan aman.';
        editSaveButton.textContent = mode === 'edit' ? 'Simpan Perubahan' : 'Edit Kamar';

        // Element teks biasa menggunakan readOnly
        modalFields.roomNumber.readOnly = !isEditable;
        modalFields.roomType.readOnly = !isEditable;
        modalFields.price.readOnly = !isEditable;
        modalFields.status.disabled = !isEditable;
        modalFields.description.readOnly = !isEditable;

        if (mode === 'view') {
            editSaveButton.classList.remove('bg-forest-700');
            editSaveButton.classList.add('bg-blue-600');
        } else {
            editSaveButton.classList.remove('bg-blue-600');
            editSaveButton.classList.add('bg-forest-700');
        }
    }

    function populateDetailModal(row) {
        modalFields.roomNumber.value = row.dataset.roomNumber || '';
        modalFields.roomType.value = row.dataset.roomType || '';
        modalFields.price.value = row.dataset.price || '';
        modalFields.roomCode.value = row.dataset.roomCode || '';
        modalFields.status.value = row.dataset.roomStatus || '';
        modalFields.description.value = row.dataset.roomDescription || '';
        modalFields.image.src = row.dataset.roomImage || 'https://via.placeholder.com/640x360';

        if (detailForm) {
            detailForm.action = `/kamar/${row.dataset.roomId}`;
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
        const roomNumber = row ? row.dataset.roomNumber || 'kamar ini' : 'kamar ini';
        const confirmed = confirm(`Hapus ${roomNumber}? Tindakan ini tidak dapat dikembalikan.`);
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

    if (roomTableBody) {
        roomTableBody.addEventListener('click', event => {
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

    if (searchInput && searchForm) {
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => searchForm.submit(), 350);
        });
    }

    if (filterType && searchForm) {
        filterType.addEventListener('change', () => searchForm.submit());
    }

    if (filterStatus && searchForm) {
        filterStatus.addEventListener('change', () => searchForm.submit());
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (createModal && !createModal.classList.contains('hidden')) closeModal(createModal);
            if (detailModal && !detailModal.classList.contains('hidden')) closeModal(detailModal);
        }
    });
});
