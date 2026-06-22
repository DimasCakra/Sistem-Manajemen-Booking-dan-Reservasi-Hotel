<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .contact-card {
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .contact-card:hover {
            transform: translateY(-10px) scale(1.02);
        }
        .contact-card:hover .icon-ring {
            transform: scale(1.1);
        }
        .icon-ring {
            transition: transform 0.3s ease;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(37, 65, 23, 0.3); }
            70% { box-shadow: 0 0 0 20px rgba(37, 65, 23, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 65, 23, 0); }
        }
        .pulse { animation: pulse-ring 2.5s infinite; }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b]">

    @include('components.navbar')

    {{-- HERO --}}
    <section class="bg-[#173014] pt-36 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 right-20 w-80 h-80 rounded-full bg-[#8C6A1A] blur-3xl"></div>
            <div class="absolute bottom-0 left-10 w-60 h-60 rounded-full bg-white blur-3xl"></div>
        </div>
        <div class="max-w-3xl mx-auto px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-5 py-2 mb-8 bg-[#8C6A1A]/20 border border-[#8C6A1A]/40 rounded-full text-[#C4922A] text-xs font-bold uppercase tracking-widest">
                Hubungi Kami
            </div>
            <h1 class="font-display text-5xl md:text-6xl font-black text-white leading-tight mb-6">
                Ada Pertanyaan?<br><span class="italic font-normal text-[#C4922A]">Kami Siap Membantu</span>
            </h1>
            <p class="text-white/70 text-lg leading-relaxed">
                Tim kami siap menjawab pertanyaan, menerima masukan, dan membantu Anda kapan saja. Pilih cara yang paling nyaman untuk Anda.
            </p>
        </div>
    </section>

    {{-- CONTACT CARDS --}}
    <section class="max-w-4xl mx-auto px-8 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- WhatsApp Card --}}
            <a href="https://wa.me/6281374117686" target="_blank" class="contact-card block bg-white rounded-3xl p-14 text-center border border-gray-100 shadow-lg hover:shadow-2xl hover:border-[#25D366]/30 group">
                <div class="icon-ring w-32 h-32 rounded-full bg-[#25D366]/10 flex items-center justify-center mx-auto mb-8 pulse">
                    <div class="w-24 h-24 rounded-full bg-[#25D366] flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="font-display text-2xl font-bold text-[#173014] mb-3">WhatsApp</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">Hubungi kami langsung melalui WhatsApp untuk respons tentang reservasi yang cepat dan personal.</p>
                <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#25D366] text-white font-bold text-sm group-hover:shadow-lg group-hover:shadow-[#25D366]/30 transition-all">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Chat di WhatsApp
                </div>
            </a>

            {{-- Gmail Card --}}
            <a href="mailto:brystr18@gmail.com" class="contact-card block bg-white rounded-3xl p-14 text-center border border-gray-100 shadow-lg hover:shadow-2xl hover:border-[#EA4335]/30 group">
                <div class="icon-ring w-32 h-32 rounded-full bg-[#EA4335]/10 flex items-center justify-center mx-auto mb-8">
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-xl border border-gray-100">
                        <svg class="w-14 h-14" viewBox="0 0 24 24" fill="none">
                            <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" fill="#EA4335"/>
                            <path d="M12 9.548L5.455 4.64 3.927 3.493C2.309 2.28 0 3.434 0 5.457v.597l12 9L24 6.054v-.597c0-2.023-2.309-3.178-3.927-1.964L18.545 4.64 12 9.548z" fill="#FBBC05"/>
                        </svg>
                    </div>
                </div>
                <h2 class="font-display text-2xl font-bold text-[#173014] mb-3">Email / Gmail</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">Kirimkan pertanyaan, saran, atau keluhan Anda melalui email. Kami akan membalas dalam 1×24 jam kerja.</p>
                <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#EA4335] text-white font-bold text-sm group-hover:shadow-lg group-hover:shadow-[#EA4335]/30 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Kirim Email
                </div>
            </a>

        </div>

        {{-- Info tambahan --}}
        <div class="mt-16 bg-[#173014] rounded-2xl p-10 text-center">
            <p class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest mb-3">Jam Operasional</p>
            <p class="font-display text-2xl text-white font-semibold mb-2">Senin – Minggu, 07.00 – 22.00 WIB</p>
            <p class="text-white/50 text-sm">Untuk keperluan darurat reservasi, tim resepsionis kami siap membantu 24 jam.</p>
        </div>
    </section>

    @include('components.footer')
</body>
</html>
