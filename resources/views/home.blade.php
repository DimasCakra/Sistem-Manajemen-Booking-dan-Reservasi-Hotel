<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Irnal Door — Home</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar">
        <a href="#" class="logo">
            <div class="logo-icon">🏨</div>
            <span class="logo-text">Irnal<span>Door</span></span>
        </a>
        <div class="nav-actions">
            <a href="/login" class="btn btn-outline">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Masuk
            </a>
            <a href="/register" class="btn btn-primary">
                Daftar Sekarang
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero">
        <!-- BG Blobs -->
        <div class="hero-bg">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        <!-- Carousel (left visual) -->
        <div class="carousel-area" id="carouselArea">
            <div class="carousel-placeholder">
            </div>
            <!-- Aktifkan ini jika sudah ada gambar:
            <div class="carousel-slides" id="carouselSlides">
                <div class="carousel-slide active">
                    <img src="{{ asset('images/hotel-1.jpg') }}" alt="Hotel View">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/hotel-2.jpg') }}" alt="Room View">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/hotel-3.jpg') }}" alt="Pool View">
                </div>
            </div>
            <div class="carousel-dots" id="carouselDots"></div>
            <div class="carousel-nav">
                <button class="carousel-btn" onclick="carouselPrev()">&#8592;</button>
                <button class="carousel-btn" onclick="carouselNext()">&#8594;</button>
            </div>
            -->
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="hero-badge">
                <div class="badge-dot"></div>
                Sistem Reservasi Hotel Terpercaya
            </div>

            <h1 class="hero-title">
                Temukan<br>
                <span class="accent">Kenyamanan</span><br>
                <span class="italic">yang Sempurna</span>
            </h1>

            <p class="hero-desc">
                Nikmati kemudahan pemesanan kamar hotel dengan sistem manajemen reservasi modern. Cari, bandingkan, dan
                booking kamar impian Anda dalam hitungan menit.
            </p>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">200<span>+</span></div>
                    <div class="stat-label">Tipe Kamar</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">50<span>K+</span></div>
                    <div class="stat-label">Tamu Puas</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">4.9<span>★</span></div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>
        </div>

        <!-- Search Card -->
        <div class="search-card">
            <div class="card-header">
                <div class="card-title">Cari Kamar Hotel</div>
                <div class="card-subtitle">Cek ketersediaan & pesan sekarang</div>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Check-in</label>
                <div class="form-input-wrapper">
                    <input type="date" class="form-input" id="checkin" name="checkin">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Check-out</label>
                <div class="form-input-wrapper">
                    <input type="date" class="form-input" id="checkout" name="checkout">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Tamu</label>
                <div class="form-input-wrapper">
                    <select class="form-select" name="guests">
                        <option value="">Pilih jumlah tamu</option>
                        <option value="1">1 Tamu</option>
                        <option value="2">2 Tamu</option>
                        <option value="3">3 Tamu</option>
                        <option value="4">4 Tamu</option>
                        <option value="5">5+ Tamu</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tipe Kamar</label>
                <div class="form-input-wrapper">
                    <select class="form-select" name="room_type">
                        <option value="">Semua tipe kamar</option>
                        <option value="standard">Standard Room</option>
                        <option value="deluxe">Deluxe Room</option>
                        <option value="suite">Suite Room</option>
                        <option value="family">Family Room</option>
                    </select>
                </div>
            </div>

            <button class="search-btn" onclick="handleSearch()">
                Cari Kamar Tersedia
            </button>

            <div class="card-sep"></div>

            <div
                style="margin-bottom:8px; font-size:11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px;">
                Populer</div>
            <div class="quick-links">
                <span class="quick-chip" onclick="setRoomType('deluxe')">Deluxe Room</span>
                <span class="quick-chip" onclick="setRoomType('suite')">Suite</span>
                <span class="quick-chip" onclick="setRoomType('family')">Family Room</span>
                <span class="quick-chip" onclick="setRoomType('standard')">Standard</span>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES STRIP ===== -->
    <div class="features-strip">
        <div class="feature-item">
            <span class="feature-icon">⚡</span>
            <div class="feature-text">
                <div class="f-title">Booking Instan</div>
                <div class="f-sub">Konfirmasi real-time</div>
            </div>
        </div>
        <div class="feature-item">
            <span class="feature-icon">🔒</span>
            <div class="feature-text">
                <div class="f-title">Pembayaran Aman</div>
                <div class="f-sub">Transaksi terenkripsi</div>
            </div>
        </div>
        <div class="feature-item">
            <span class="feature-icon">🎯</span>
            <div class="feature-text">
                <div class="f-title">Best Price Guarantee</div>
                <div class="f-sub">Harga terbaik dijamin</div>
            </div>
        </div>
        <div class="feature-item">
            <span class="feature-icon">🛎️</span>
            <div class="feature-text">
                <div class="f-title">Layanan 24/7</div>
                <div class="f-sub">Siap membantu kapan saja</div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-grid reveal">
            <div class="footer-brand">
                <a href="#" class="logo">
                    <div class="logo-icon" style="width:36px;height:36px;font-size:16px;">🏨</div>
                    <span class="logo-text">Luxe<span>Stay</span></span>
                </a>
                <p>Platform manajemen booking dan reservasi hotel terpercaya. Memberikan pengalaman menginap terbaik
                    sejak 2024.</p>
                <div class="footer-social">
                    <a href="#" class="social-btn">f</a>
                    <a href="#" class="social-btn">in</a>
                    <a href="#" class="social-btn">tw</a>
                    <a href="#" class="social-btn">ig</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Reservasi Kamar</a></li>
                    <li><a href="#">Paket Liburan</a></li>
                    <li><a href="#">Meeting Room</a></li>
                    <li><a href="#">Event & Banquet</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Akun</h4>
                <ul>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Daftar</a></li>
                    <li><a href="#">Riwayat Booking</a></li>
                    <li><a href="#">Profil Saya</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 <span>LuxeStay</span>. Hak cipta dilindungi. Dibuat dengan ❤️ menggunakan Laravel.</p>
            <div class="footer-badge">
                <span>Laravel</span> × Sistem Booking Hotel
            </div>
        </div>
    </footer>