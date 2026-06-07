document.addEventListener('DOMContentLoaded', () => {
    // Definisi Elemen DOM
    const createModal = document.getElementById('createModal');
    const openCreateModalBtn = document.getElementById('openCreateModal');
    const detailModal = document.getElementById('detailModal');
    const detailForm = document.getElementById('detailModalForm');
    const detailModalTitle = document.getElementById('detailModalTitle');
    const detailModalSubtitle = document.getElementById('detailModalSubtitle');
    const editSaveButton = document.getElementById('editSaveButton');

    // Fields Form
    const detailRoomNumber = document.getElementById('detailRoomNumber');
    const detailRoomType = document.getElementById('detailRoomType');
    const detailRoomPrice = document.getElementById('detailRoomPrice');
    const detailRoomStatus = document.getElementById('detailRoomStatus');
    const detailRoomDescription = document.getElementById('detailRoomDescription');
    const imageContainer = document.getElementById('detailRoomImageContainer');

    let isEditMode = false;

    // --- LOGIKA MODAL TAMBAH ---
    if (openCreateModalBtn) {
        openCreateModalBtn.addEventListener('click', () => {
            createModal.classList.replace('hidden', 'flex');
        });
    }

    // --- FUNGSI MAPPING DATA ---
    function mapRowToModal(row) {
        detailRoomNumber.value = row.dataset.roomNumber;
        detailRoomType.value = row.dataset.roomTypeId;
        detailRoomStatus.value = row.dataset.roomStatus;
        detailRoomDescription.value = row.dataset.roomDescription;

        const price = parseInt(row.dataset.price || 0);
        detailRoomPrice.value = 'Rp ' + price.toLocaleString('id-ID');

        imageContainer.innerHTML = '';
        const images = JSON.parse(row.dataset.roomImages || '[]');

        if (images.length > 0) {
            images.forEach(src => {
                const img = document.createElement('img');
                img.src = src;
                img.className = "h-24 w-full object-cover rounded-xl border border-slate-200 shadow-sm";
                imageContainer.appendChild(img);
            });
        } else {
            imageContainer.innerHTML = '<p class="text-xs text-gray-400 py-4 text-center">Tidak ada foto.</p>';
        }
    }

    // --- EVENT LISTENER TABEL (LIHAT & EDIT) ---
    document.getElementById('roomTableBody').addEventListener('click', (e) => {
        const viewBtn = e.target.closest('.btn-view');
        const editBtn = e.target.closest('.btn-edit');

        if (!viewBtn && !editBtn) return;

        const row = (viewBtn || editBtn).closest('tr');

        // PENTING: Menggunakan id (integer) untuk URL update
        detailForm.action = `/admin/kamar/${row.dataset.roomId}`;

        mapRowToModal(row);

        if (viewBtn) {
            setMode(false);
        } else if (editBtn) {
            setMode(true);
        }

        detailModal.classList.replace('hidden', 'flex');
    });

    // --- FUNGSI SET MODE (UI UI SWITCHER) ---
    function setMode(edit) {
        isEditMode = edit;
        detailModalTitle.textContent = edit ? "Edit Kamar" : "Detail Kamar";
        detailModalSubtitle.textContent = edit ? "Ubah detail unit kamar." : "Spesifikasi tipe kamar.";

        detailRoomNumber.readOnly = !edit;
        detailRoomType.disabled = !edit;
        detailRoomStatus.disabled = !edit;

        editSaveButton.textContent = edit ? "Simpan Perubahan" : "Edit Kamar";
        editSaveButton.type = edit ? "submit" : "button";
        editSaveButton.className = edit
            ? "px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-sm transition hover:bg-emerald-700"
            : "px-6 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm transition hover:bg-blue-700";
    }

    // --- HANDLER TOMBOL EDIT DI DALAM MODAL ---
    editSaveButton.addEventListener('click', (e) => {
        if (!isEditMode) {
            e.preventDefault(); // Mencegah submit, hanya switch mode
            setMode(true);
        }
    });

    // --- CLOSE MODAL ---
    document.querySelectorAll('.modal-close').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            createModal.classList.replace('flex', 'hidden');
            detailModal.classList.replace('flex', 'hidden');
        });
    });
});
