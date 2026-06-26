<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b] font-sans">
    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10" x-data="{ method: 'bca' }">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Payment Deadline -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Batas Waktu Pembayaran</h2>
                        <p class="text-xl font-black text-[#0f172a]">{{ $reservation->created_at->addMinutes(15)->format('d M Y, H:i') }}</p>
                    </div>
                    <div x-data="{
                            timeLeft: {{ max(0, \Carbon\Carbon::now()->diffInSeconds($reservation->created_at->addMinutes(15), false)) }},
                            get formattedTime() {
                                const m = String(Math.floor(this.timeLeft / 60)).padStart(2, '0');
                                const s = String(Math.floor(this.timeLeft % 60)).padStart(2, '0');
                                return `${m}:${s}`;
                            }
                        }"
                        x-init="setInterval(() => { if (timeLeft > 0) { timeLeft--; } else { window.location.href = '{{ route('home') }}'; } }, 1000)"
                        class="bg-red-50 text-red-600 px-6 py-3 rounded-md font-bold text-xl text-center border border-red-100 tabular-nums"
                        x-text="formattedTime">
                        15:00
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Metode Pembayaran</h2>

                    <div class="space-y-4">
                        <div x-data="{open:false}">
                            <label @click="method='bca'; open=!open" class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'bca' ? 'border-[#254117] bg-green-50/20' : 'border-gray-200 hover:bg-gray-50'">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="bca" x-model="method" class="w-5 h-5 text-[#254117]">
                                    <span class="font-bold text-lg">BCA Rekening</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-6">
                            </label>

                            <div x-show="method==='bca'" x-transition class="mt-2 p-5 bg-gray-50 border rounded-md">
                                <p class="text-sm text-gray-500 uppercase font-bold">Nomor Rekening Hotel</p>
                                <p class="text-2xl font-black text-[#254117] mt-2">8800 1234 5678 9012</p>
                            </div>
                        </div>

                        <div>
                            <label @click="method='mandiri'" class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'mandiri' ? 'border-[#254117] bg-green-50/20' : 'border-gray-200 hover:bg-gray-50'">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="mandiri" x-model="method" class="w-5 h-5 text-[#254117]">
                                    <span class="font-bold text-lg">Mandiri Rekening</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="h-6">
                            </label>

                            <div x-show="method==='mandiri'" x-transition class="mt-2 p-5 bg-gray-50 border rounded-md">
                                <p class="text-sm text-gray-500 uppercase font-bold">Nomor Rekening Hotel</p>
                                <p class="text-2xl font-black text-[#254117] mt-2">1090 0247 0262 3</p>
                            </div>
                        </div>

                        <div>
                            <label @click="method='qris'" class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'qris' ? 'border-[#254117] bg-green-50/20' : 'border-gray-200 hover:bg-gray-50'">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="qris" x-model="method" class="w-5 h-5 text-[#254117]">
                                    <span class="font-bold text-lg">QRIS</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="h-6">
                            </label>

                            <div x-show="method==='qris'" x-transition class="mt-2 p-5 bg-gray-50 border rounded-md text-center">
                                <p class="text-sm text-gray-500 uppercase font-bold mb-3">Scan QRIS Hotel</p>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=StayEasePayment-{{ $id }}-{{ $total }}" class="mx-auto border rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Summary Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Lihat Pesanan</h2>

                    <div class="mb-6">
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Hotel</p>
                        <h3 class="text-lg font-black text-black">StayEase Luxury Hotel</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $kamar->nama_tipe }} - {{ $durasi }} Night(s)</p>
                    </div>

                   <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Check-in</span>
                            <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($checkin)->format('d-M-Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Check-out</span>
                            <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($checkout)->format('d-M-Y') }}</span>
                        </div>
                    </div>


                    <div class="border-t border-gray-100 pt-4 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-black">Total Pembayaran</span>
                            <span class="text-xl font-black text-[#254117]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm" x-data="{ photoPreview: null }">
                    <h2 class="text-lg font-black text-[#0f172a] mb-4 uppercase tracking-widest">Upload Bukti</h2>

                    <form id="payment-form" action="{{ route('booking.payment.store', ['reservation_id' => $id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="payment_method" x-bind:value="method">
                        <div class="relative">
                            <!-- Preview Area -->
                            <template x-if="photoPreview">
                                <div class="mb-4 relative">
                                    <img :src="photoPreview" class="w-full h-48 object-cover rounded-lg border-2 border-dashed border-gray-200">
                                    <button type="button" @click="photoPreview = null; $refs.photoInput.value = ''" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </template>

                            <label x-show="!photoPreview" class="flex flex-col items-center justify-center w-full h-31 border-2 border-dashed border-gray-200 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.587-1.587a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-xs font-bold text-gray-500 uppercase">Klik untuk Upload Bukti</p>
                                </div>
                                <input type="file" name="bukti_pembayaran" class="hidden" x-ref="photoInput" accept="image/*" required
                                    @change="
                                        const file = $event.target.files[0];
                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => { photoPreview = e.target.result; };
                                            reader.readAsDataURL(file);
                                        }
                                    ">
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-[#254117] hover:bg-[#1a2f0f] text-white py-4 rounded-xl font-bold uppercase tracking-widest text-sm transition-all shadow-md">
                            Konfirmasi Pembayaran
                        </button>
                    </form>

                    <form action="{{ route('booking.payment.cancel', ['reservation_id' => $id]) }}" method="POST" class="mt-4" id="cancel-form">
                        @csrf
                        <button type="button" id="cancel-reservation-btn" class="w-full bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 py-4 rounded-xl font-bold uppercase tracking-widest text-sm transition-all shadow-sm">
                            Batalkan Reservasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
    <style>
        /* Base: keep no entry animations */
        .swal2-container, .swal2-popup {
            transition: none !important;
            -webkit-transition: none !important;
            animation: none !important;
            -webkit-animation: none !important;
        }
        .swal2-styled, .swal2-styled:focus, .swal2-styled:active {
            transition: none !important;
            -webkit-transition: none !important;
            box-shadow: none !important;
        }

        /* Button hover colors: green (darker) and red (darker) */
        .swal-btn-green:hover {
            background-color: #1a2f0f !important; /* darker green */
            color: #ffffff !important;
        }

        .swal-btn-red:hover {
            background-color: #b91c1c !important; /* darker red */
            color: #ffffff !important;
        }

        /* Ensure our specific button hover rules win over generic unset rules */
        .swal-btn-green, .swal-btn-red { transition: none !important; }
        /* Remove popup entry animations and hover/transition effects entirely */
        .swal2-container, .swal2-popup {
            transition: none !important;
            -webkit-transition: none !important;
            animation: none !important;
            -webkit-animation: none !important;
        }
        .swal2-styled, .swal-nohover-confirm, .swal-nohover-cancel {
            transition: none !important;
            -webkit-transition: none !important;
            box-shadow: none !important;
        }
        /* Hilangkan animasi popup */
        .swal2-container,
        .swal2-popup {
            transition: none !important;
            animation: none !important;
        }

        /* Tombol konfirmasi hijau */
        .swal-btn-green {
            background-color: #254117 !important;
            color: white !important;
            border-radius: 8px !important;
        }
        .swal-btn-green:hover {
            background-color: #1a2f0f !important;
            color: white !important;
        }

        /* Tombol batal merah */
        .swal-btn-red {
            background-color: #dc2626 !important;
            color: white !important;
            border-radius: 8px !important;
        }
        .swal-btn-red:hover {
            background-color: #991b1b !important;
            color: white !important;
        }

        /* Hilangkan efek default SweetAlert */
        .swal2-styled:focus {
            box-shadow: none !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let isSubmitting = false;

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            isSubmitting = true;

            Swal.fire({
                title: 'Bukti berhasil diunggah',
                text: 'Silakan tunggu verifikasi resepsionis. Bukti booking akan dikirimkan melalui nomor WhatsApp anda.',
                showCancelButton: false,
                confirmButtonText: 'Baik, mengerti',
                confirmButtonColor: '#254117',
                allowOutsideClick: false,
                customClass: { confirmButton: 'swal-btn-green' }
            }).then(() => {
                this.submit();
            });
        });

        // Prevent accidental navigation: intercept link clicks and back/forward via history
        history.pushState(null, null, location.href);

        const sendCancel = async () => {
            try {
                await fetch('{{ route('booking.payment.cancel', $id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new URLSearchParams({}),
                });
            } catch (e) {
                // best-effort
                try {
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    navigator.sendBeacon('{{ route('booking.payment.cancel', $id) }}', formData);
                } catch (e) {}
            }
        };

        // Intercept back/forward navigation
        window.addEventListener('popstate', function (event) {
            if (isSubmitting) return;

            Swal.fire({
                title: 'Konfirmasi pembatalan reservasi',
                text: 'Keluar sekarang akan membatalkan proses reservasi dan menghapus data sementara. Lanjutkan?',
                showCancelButton: true,
                confirmButtonText: 'Keluar dan batalkan',
                cancelButtonText: 'Tetap di halaman',
                confirmButtonColor: '#d2626',
                cancelButtonColor: '#254117',
                customClass: { confirmButton: 'swal-btn-red', cancelButton: 'swal-btn-green' }
            }).then((result) => {
                if (result.isConfirmed) {
                    isSubmitting = true;
                    sendCancel().then(() => {
                        // allow back navigation now
                        history.back();
                    }).catch(() => {
                        history.back();
                    });
                } else {
                    // stay on page
                    history.pushState(null, null, location.href);
                }
            });
        });

        // Intercept anchor clicks
        document.addEventListener('click', function (e) {
            const a = e.target.closest('a');
            if (!a) return;
            const href = a.getAttribute('href');
            if (!href || href.startsWith('#') || a.target === '_blank') return;
            if (isSubmitting) return;

            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi pembatalan reservasi',
                text: 'Keluar sekarang akan membatalkan proses reservasi dan menghapus data sementara. Lanjutkan?',
                showCancelButton: true,
                confirmButtonText: 'Keluar dan batalkan',
                cancelButtonText: 'Tetap di halaman',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#254117',
                customClass: { confirmButton: 'swal-btn-red', cancelButton: 'swal-btn-green' }
            }).then((result) => {
                if (result.isConfirmed) {
                    isSubmitting = true;
                    sendCancel().then(() => {
                        window.location.href = href;
                    }).catch(() => {
                        window.location.href = href;
                    });
                }
            });
        });

        // Handle cancel-reservation button (show confirmation then cancel and redirect to home)
        const cancelBtn = document.getElementById('cancel-reservation-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function (e) {
                if (isSubmitting) return;

                Swal.fire({
                    title: 'Konfirmasi pembatalan reservasi',
                    text: 'Batalkan reservasi ini? Semua data sementara akan dihapus.',
                    showCancelButton: true,
                    confirmButtonText: 'Keluar dan batalkan',
                    cancelButtonText: 'Tetap di halaman',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#254117',
                    customClass: { confirmButton: 'swal-btn-red', cancelButton: 'swal-btn-green' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        isSubmitting = true;
                        sendCancel().then(() => {
                            window.location.href = '{{ route('home') }}';
                        }).catch(() => {
                            window.location.href = '{{ route('home') }}';
                        });
                    }
                });
            });
        }

        // Warn before leaving without auto-cancelling the reservation
        window.addEventListener('beforeunload', function (e) {
            if (!isSubmitting) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
</body>
</html>
