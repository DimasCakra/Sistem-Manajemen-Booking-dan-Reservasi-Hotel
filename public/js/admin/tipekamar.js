document.addEventListener('DOMContentLoaded', () => {
    // Definisi Elemen DOM Utama Halaman Tipe Kamar
    const typeModal = document.getElementById('typeModal');
    const modalForm = document.getElementById('modalForm');
    const formMethod = document.getElementById('formMethod');
    const modalTitle = document.getElementById('modalTitle');
    const openCreateModalBtn = document.getElementById('openCreateModal');

    // Form Input di Dalam Modal
    const typeName = document.getElementById('typeName');
    const typeCode = document.getElementById('typeCode'); // <-- Kolom Kode Tipe Kamar
    const typePrice = document.getElementById('typePrice');
    const typeDescription = document.getElementById('typeDescription');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const typeTableBody = document.getElementById('typeTableBody');

    // --- AKSI TOMBOL: BUKA MODAL TAMBAH DATA ---
    if (openCreateModalBtn && typeModal) {
        openCreateModalBtn.addEventListener('click', () => {
            modalForm.reset();
            modalTitle.textContent = "Tambah Tipe Kamar Master";
            modalForm.action = "/admin/tipe-kamar"; // Mengarah ke Route::post('/tipe-kamar')
            formMethod.value = "POST";

            // Sembunyikan kontainer peninjau gambar
            if (previewContainer) {
                previewContainer.innerHTML = '';
                previewContainer.classList.add('hidden');
            }

            typeModal.classList.remove('hidden');
            typeModal.classList.add('flex');
        });
    }

    // --- AKSI DELEGASI TABEL: DETEKSI KLIK TOMBOL EDIT ---
    if (typeTableBody) {
        typeTableBody.addEventListener('click', (e) => {
            const btnEdit = e.target.closest('.btn-edit');
            if (!btnEdit) return;

            // Tarik baris data terdekat dari tombol yang diklik
            const row = btnEdit.closest('tr');
            if (!row) return;

            modalTitle.textContent = "Edit Tipe Kamar Master";
            modalForm.action = `/admin/tipe-kamar/${row.dataset.id}`; // Mengarah ke Route::put('/tipe-kamar/{id}')
            formMethod.value = "PUT";

            // Mapping value dataset baris ke dalam input form modal
            if (typeName) typeName.value = row.dataset.name || '';
            if (typeCode) typeCode.value = row.dataset.code || ''; // <-- Ambil kode dari data-code baris tabel
            if (typePrice) typePrice.value = row.dataset.price || '';
            if (typeDescription) typeDescription.value = row.dataset.description || '';

            // Bersihkan kontainer pratinjau gambar lama
            if (previewContainer) {
                previewContainer.innerHTML = '';
                const images = JSON.parse(row.dataset.images || '[]');

                if (images.length > 0) {
                    previewContainer.classList.remove('hidden');
                    images.forEach(src => {
                        const img = document.createElement('img');
                        img.src = src;
                        img.className = "h-20 w-full object-cover rounded-lg border border-slate-200 shadow-sm";
                        previewContainer.appendChild(img);
                    });
                } else {
                    previewContainer.classList.add('hidden');
                }
            }

            typeModal.classList.remove('hidden');
            typeModal.classList.add('flex');
        });
    }

    // --- LOGIK PENUTUPAN MODAL (TOMBOL SILANG ATAU BATAL) ---
    document.querySelectorAll('.modal-close').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            if (typeModal) {
                typeModal.classList.remove('flex');
                typeModal.classList.add('hidden');
            }
        });
    });
});
