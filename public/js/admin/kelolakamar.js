document.addEventListener('DOMContentLoaded', () => {
    const openCreateModalButton = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const detailModal = document.getElementById('detailModal');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    const roomTableBody = document.getElementById('roomTableBody');
    const detailModalTitle = document.getElementById('detailModalTitle');
    const detailModalSubtitle = document.getElementById('detailModalSubtitle');
    const editSaveButton = document.getElementById('editSaveButton');

    // Search and Filter Elements
    const searchInput = document.getElementById('searchInput');
    const filterType = document.getElementById('filterType');
    const filterStatus = document.getElementById('filterStatus');

    let currentRow = null;
    let currentMode = 'view';

    const modalFields = {
        roomNumber: document.getElementById('detailRoomNumber'),
        roomType: document.getElementById('detailRoomType'), // Sekarang berupa element <select>
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
        modalFields.price.readOnly = !isEditable;
        modalFields.status.readOnly = !isEditable;
        modalFields.description.readOnly = !isEditable;

        // Penyesuaian khusus elemen <select> Tipe Kamar menggunakan disabled
        if (modalFields.roomType) {
            modalFields.roomType.disabled = !isEditable;
        }

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
        modalFields.roomType.value = row.dataset.roomType || ''; // Mengatur value select option agar otomatis terpilih
        modalFields.price.value = row.dataset.price || '';
        modalFields.roomCode.value = row.dataset.roomCode || '';
        modalFields.status.value = row.dataset.roomStatus || '';
        modalFields.description.value = row.dataset.roomDescription || '';
        modalFields.image.src = row.dataset.roomImage || 'https://via.placeholder.com/640x360';
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
        const row = event.target.closest('tr');
        if (!row) return;
        const roomNumber = row.dataset.roomNumber || 'kamar ini';
        const confirmed = confirm(`Hapus ${roomNumber}? Tindakan ini tidak dapat dikembalikan.`);
        if (confirmed) {
            row.remove();
        }
    }

    function applyModalUpdates() {
        if (!currentRow) return;
        currentRow.dataset.roomNumber = modalFields.roomNumber.value;
        currentRow.dataset.roomType = modalFields.roomType.value;
        currentRow.dataset.price = modalFields.price.value;
        currentRow.dataset.roomStatus = modalFields.status.value;
        currentRow.dataset.roomDescription = modalFields.description.value;

        currentRow.querySelector('td:nth-child(1)').textContent = modalFields.roomNumber.value;
        currentRow.querySelector('td:nth-child(2)').textContent = modalFields.roomType.value;
        currentRow.querySelector('td:nth-child(3)').textContent = modalFields.price.value;
        currentRow.querySelector('td:nth-child(5) span').textContent = modalFields.status.value;
        currentRow.querySelector('td:nth-child(6)').textContent = modalFields.description.value;
        closeModal(detailModal);
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
            applyModalUpdates();
        });
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            if (createModal && !createModal.classList.contains('hidden')) closeModal(createModal);
            if (detailModal && !detailModal.classList.contains('hidden')) closeModal(detailModal);
        }
    });
});
