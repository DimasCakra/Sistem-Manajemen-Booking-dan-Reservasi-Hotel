<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Nomor Identitas - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display, h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-white min-h-screen font-sans flex">

    <!-- Left: Image Showcase -->
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&q=80" alt="Hotel Room" class="absolute inset-0 w-full h-full object-cover transform scale-105 hover:scale-100 transition-transform duration-[10s]">
        <div class="absolute inset-0 bg-[#254117]/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#173014] via-[#173014]/20 to-transparent"></div>
        
        <div class="absolute bottom-16 left-16 right-16 text-white">
            <div class="w-12 h-1 bg-[#FFF4DE] mb-8"></div>
            <h2 class="text-5xl font-bold font-serif mb-6 leading-tight">Just one more step.</h2>
            <p class="text-white/90 text-xl max-w-lg leading-relaxed font-light">Set up your Nomor Identitas to complete your StayEase profile and start booking.</p>
        </div>
    </div>

    <!-- Right: Nomor Identitas Form -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 lg:p-24 relative bg-[#FFF4DE]">
        
        <div class="w-full max-w-md">
            <div class="text-center mb-12">
                <img src="{{ asset('gambar/stayease.png') }}" alt="StayEase Logo" class="h-16 mx-auto mb-8 object-contain">
                <h1 class="text-4xl font-bold text-[#173014] mb-3 font-serif">Masukkan Nomor Identitas Anda</h1>
                <p class="text-gray-500 font-medium">Pilih jenis identitas Anda: <strong>NIK</strong> (16 digit) untuk WNI, atau <strong>Nomor Paspor</strong> (maks. 9 karakter) untuk WNA.</p>
            </div>

            <form action="{{ route('id_number.post') }}" method="POST" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm mb-8 shadow-sm">
                        <ul class="list-disc list-inside font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-2">
                    <label for="id_number" class="block text-xs font-bold text-[#254117] uppercase tracking-widest ml-1">Nomor Identitas</label>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select name="id_type" id="id_type" class="w-full sm:w-1/3 px-5 py-4 rounded-xl bg-white border-2 border-transparent focus:border-[#254117] outline-none text-gray-800 transition-all shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] appearance-none cursor-pointer">
                            <option value="NIK">🇮🇩 NIK</option>
                            <option value="Paspor">🌐 Paspor</option>
                        </select>
                        <input id="id_number" type="text" name="id_number" required placeholder="e.g. 1234567890123456"
                            class="w-full sm:w-2/3 px-5 py-4 rounded-xl bg-white border-2 border-transparent focus:border-[#254117] outline-none text-gray-800 transition-all shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)]">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-[#254117] text-white mt-8 py-4 rounded-xl font-bold tracking-widest uppercase hover:bg-[#173014] transition-all transform active:scale-[0.98] shadow-xl shadow-[#254117]/20 flex justify-center items-center gap-2">
                    Mulai
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
</form>

<script>
    // Prevent cancel action when the form is submitted normally
    let isSubmitting = false;
    const mainForm = document.querySelector('form[action="{{ route('id_number.post') }}"]');
    if (mainForm) {
        mainForm.addEventListener('submit', function () {
            isSubmitting = true;
        });
    }
    // When user navigates away (e.g., back button), clear registration data via beacon
    window.addEventListener('beforeunload', function (e) {
        if (isSubmitting) return;
        // send a POST request without blocking navigation
        if (navigator.sendBeacon) {
            navigator.sendBeacon('{{ route('register.cancel') }}', '');
        }
    });
</script>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idTypeSelect = document.getElementById('id_type');
            const idNumberInput = document.getElementById('id_number');

            function updateValidation() {
                if (idTypeSelect.value === 'NIK') {
                    idNumberInput.setAttribute('minlength', '16');
                    idNumberInput.setAttribute('maxlength', '16');
                    idNumberInput.setAttribute('pattern', '[0-9]{16}');
                    idNumberInput.setAttribute('title', 'NIK harus 16 digit angka');
                    idNumberInput.placeholder = 'e.g. 1234567890123456';
                    // Allow only numbers
                    idNumberInput.value = idNumberInput.value.replace(/[^0-9]/g, '').slice(0, 16);
                } else {
                    idNumberInput.removeAttribute('minlength');
                    idNumberInput.setAttribute('maxlength', '9');
                    idNumberInput.setAttribute('pattern', '[A-Za-z0-9]{1,9}');
                    idNumberInput.setAttribute('title', 'Paspor maksimal 9 karakter huruf/angka');
                    idNumberInput.placeholder = 'e.g. A1234567';
                    // Allow only alphanumeric
                    idNumberInput.value = idNumberInput.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, 9);
                }
            }

            idTypeSelect.addEventListener('change', updateValidation);
            idNumberInput.addEventListener('input', updateValidation);
            
            // Initialize
            updateValidation();
        });

