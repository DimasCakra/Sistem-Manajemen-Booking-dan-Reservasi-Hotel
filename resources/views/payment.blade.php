<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFF4DE; color: #1a1a1a; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 15px 40px -10px rgba(0,0,0,0.05);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #2a5a3b 0%, #1e3c28 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #1e3c28 0%, #14281a 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(30, 60, 40, 0.4);
        }
        
        .btn-outline-red {
            border: 2px solid #fee2e2;
            color: #ef4444;
            transition: all 0.3s ease;
        }
        .btn-outline-red:hover {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #dc2626;
        }

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
        .swal-btn-green {
            background-color: #254117 !important;
            color: white !important;
            border-radius: 8px !important;
        }
        .swal-btn-green:hover {
            background-color: #1a2f0f !important;
            color: white !important;
        }

        .swal-btn-red {
            background-color: #dc2626 !important;
            color: white !important;
            border-radius: 8px !important;
        }
        .swal-btn-red:hover {
            background-color: #991b1b !important;
            color: white !important;
        }
    </style>
</head>
<body class="antialiased selection:bg-[#2a5a3b] selection:text-white">
    @include('components.navbar')

    <main class="max-w-7xl mx-auto px-6 pt-12 pb-20" x-data="{ method: 'bca' }">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="font-playfair text-4xl md:text-5xl font-bold text-[#1a2f0f] mb-3">Pembayaran</h1>
            <p class="text-gray-600">Pilih metode pembayaran dan unggah bukti transfer Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Payment Deadline -->
                <div class="glass-panel p-8 rounded-[2rem] flex flex-col md:flex-row items-center justify-between gap-6 border-l-4 border-l-orange-400">
                    <div class="text-center md:text-left">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2"><i class="fa-regular fa-clock mr-1"></i> Batas Waktu Pembayaran</h2>
                        <p class="text-2xl font-playfair font-bold text-[#1a2f0f]">{{ $reservation->created_at->addMinutes(15)->format('d M Y, H:i') }}</p>
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
                        class="bg-orange-50 text-orange-600 px-6 py-4 rounded-xl font-bold text-3xl tracking-wider text-center border border-orange-100 tabular-nums shadow-inner"
                        x-text="formattedTime">
                        15:00
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="glass-panel p-8 md:p-10 rounded-[2rem]">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-[#2a5a3b]/10 flex items-center justify-center text-[#2a5a3b]">
                            <i class="fa-solid fa-credit-card text-xl"></i>
                        </div>
                        <h2 class="font-playfair text-2xl font-bold text-[#1a2f0f]">Metode Pembayaran</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- BCA -->
                        <div class="bg-gray-50/50 rounded-xl overflow-hidden border border-gray-200 transition-all" :class="method === 'bca' ? 'ring-2 ring-[#2a5a3b] border-transparent shadow-sm' : ''">
                            <label @click="method='bca'" class="flex items-center justify-between p-6 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors" :class="method === 'bca' ? 'border-[#2a5a3b]' : 'border-gray-300'">
                                        <div class="w-3 h-3 rounded-full bg-[#2a5a3b] transition-transform" :class="method === 'bca' ? 'scale-100' : 'scale-0'"></div>
                                    </div>
                                    <span class="font-bold text-lg text-gray-800">Transfer BCA</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-6 object-contain">
                            </label>
                            <div x-show="method==='bca'" x-collapse>
                                <div class="p-6 bg-white border-t border-gray-100 flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Nomor Rekening StayEase</p>
                                        <p class="text-2xl font-bold text-[#1a2f0f] tracking-widest">8800 1234 5678 9012</p>
                                    </div>
                                    <button type="button" @click="navigator.clipboard.writeText('8800123456789012')" class="text-[#2a5a3b] hover:text-[#1a2f0f] p-3 bg-[#2a5a3b]/10 rounded-xl transition-colors" title="Salin Rekening">
                                        <i class="fa-regular fa-copy text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mandiri -->
                        <div class="bg-gray-50/50 rounded-xl overflow-hidden border border-gray-200 transition-all" :class="method === 'mandiri' ? 'ring-2 ring-[#2a5a3b] border-transparent shadow-sm' : ''">
                            <label @click="method='mandiri'" class="flex items-center justify-between p-6 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors" :class="method === 'mandiri' ? 'border-[#2a5a3b]' : 'border-gray-300'">
                                        <div class="w-3 h-3 rounded-full bg-[#2a5a3b] transition-transform" :class="method === 'mandiri' ? 'scale-100' : 'scale-0'"></div>
                                    </div>
                                    <span class="font-bold text-lg text-gray-800">Transfer Mandiri</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="h-6 object-contain">
                            </label>
                            <div x-show="method==='mandiri'" x-collapse>
                                <div class="p-6 bg-white border-t border-gray-100 flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Nomor Rekening StayEase</p>
                                        <p class="text-2xl font-bold text-[#1a2f0f] tracking-widest">1090 0247 0262 3</p>
                                    </div>
                                    <button type="button" @click="navigator.clipboard.writeText('1090024702623')" class="text-[#2a5a3b] hover:text-[#1a2f0f] p-3 bg-[#2a5a3b]/10 rounded-xl transition-colors" title="Salin Rekening">
                                        <i class="fa-regular fa-copy text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- QRIS -->
                        <div class="bg-gray-50/50 rounded-xl overflow-hidden border border-gray-200 transition-all" :class="method === 'qris' ? 'ring-2 ring-[#2a5a3b] border-transparent shadow-sm' : ''">
                            <label @click="method='qris'" class="flex items-center justify-between p-6 cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors" :class="method === 'qris' ? 'border-[#2a5a3b]' : 'border-gray-300'">
                                        <div class="w-3 h-3 rounded-full bg-[#2a5a3b] transition-transform" :class="method === 'qris' ? 'scale-100' : 'scale-0'"></div>
                                    </div>
                                    <span class="font-bold text-lg text-gray-800">QRIS</span>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="h-6 object-contain">
                            </label>
                            <div x-show="method==='qris'" x-collapse>
                                <div class="p-8 bg-white border-t border-gray-100 text-center flex flex-col items-center">
                                    <p class="text-sm text-gray-500 font-medium mb-4">Scan QR Code di bawah menggunakan aplikasi E-Wallet atau M-Banking Anda</p>
                                    <div class="p-4 bg-white border-2 border-dashed border-[#2a5a3b]/30 rounded-2xl inline-block shadow-sm">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=StayEasePayment-{{ $id }}-{{ $total }}" class="w-48 h-48">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 relative">
                <div class="sticky top-28 space-y-6">
                    
                    <!-- Summary Card -->
                    <div class="glass-panel p-8 rounded-[2rem]">
                        <h2 class="text-xs font-bold text-gray-400 mb-6 uppercase tracking-widest border-b border-gray-100 pb-4">Rincian Pesanan</h2>

                        <div class="mb-6">
                            <h3 class="font-playfair text-xl font-bold text-[#1a2f0f]">{{ $kamar->nama_tipe }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $durasi }} Malam</p>
                        </div>

                        <div class="bg-gray-50/80 rounded-xl p-4 mb-6 grid grid-cols-2 gap-4 border border-gray-100">
                            <div>
                                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Check-in</span>
                                <span class="block text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($checkin)->format('d M Y') }}</span>
                            </div>
                            <div class="border-l border-gray-200 pl-4">
                                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Check-out</span>
                                <span class="block text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($checkout)->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6 flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Total Harga</span>
                            <span class="text-2xl font-bold text-[#2a5a3b]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Upload & Confirm -->
                    <div class="glass-panel p-8 rounded-[2rem]" x-data="{ photoPreview: null }">
                        <h2 class="text-xs font-bold text-gray-400 mb-6 uppercase tracking-widest border-b border-gray-100 pb-4"><i class="fa-solid fa-upload mr-1"></i> Upload Bukti</h2>

                        <form id="payment-form" action="{{ route('booking.payment.store', ['reservation_id' => $id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="payment_method" x-bind:value="method">
                            
                            <div class="relative">
                                <!-- Preview Area -->
                                <template x-if="photoPreview">
                                    <div class="relative rounded-2xl overflow-hidden border-2 border-[#2a5a3b]/30 shadow-sm group bg-white">
                                        <img :src="photoPreview" class="w-full h-40 object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" @click="photoPreview = null; $refs.photoInput.value = ''" class="bg-red-500 hover:bg-red-600 text-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center transform transition-transform hover:scale-110">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <!-- Upload Area -->
                                <label x-show="!photoPreview" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-[#2a5a3b]/30 rounded-2xl cursor-pointer bg-white hover:bg-green-50/30 hover:border-[#2a5a3b] transition-all group">
                                    <div class="flex flex-col items-center justify-center p-6 text-center">
                                        <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-[#2a5a3b]/10 group-hover:text-[#2a5a3b] text-gray-400 transition-colors mb-3">
                                            <i class="fa-solid fa-image text-xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-gray-700 mb-1">Pilih File Bukti</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Format: JPG, PNG, JPEG</p>
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

                            <button type="submit" class="btn-gradient w-full text-white py-4 rounded-xl font-bold tracking-wide flex items-center justify-center gap-2 group shadow-md">
                                Konfirmasi Pembayaran
                                <i class="fa-solid fa-check text-sm group-hover:scale-110 transition-transform"></i>
                            </button>
                        </form>

                        <form action="{{ route('booking.payment.cancel', ['reservation_id' => $id]) }}" method="POST" class="mt-4" id="cancel-form">
                            @csrf
                            <button type="button" id="cancel-reservation-btn" class="btn-outline-red w-full py-4 rounded-xl font-bold tracking-wide flex items-center justify-center gap-2">
                                <i class="fa-solid fa-xmark text-sm"></i>
                                Batalkan Reservasi
                            </button>
                        </form>
                    </div>

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

        // Keep a last-resort beforeunload warning and best-effort cancel beacon
        window.addEventListener('beforeunload', function (e) {
            if (!isSubmitting) {
                e.preventDefault();
                e.returnValue = '';
                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                navigator.sendBeacon('{{ route('booking.payment.cancel', $id) }}', formData);
            }
        });
    </script>
</body>
</html>
