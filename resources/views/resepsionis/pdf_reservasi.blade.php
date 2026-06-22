<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bukti Reservasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #254117;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #254117;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 12px;
        }
        .section-title {
            background: #254117;
            color: white;
            padding: 8px 10px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            width: 35%;
            color: #555;
            background: #f9f9f9;
        }
        .bukti-container {
            text-align: center;
            margin-top: 20px;
        }
        .bukti-container img {
            max-width: 100%;
            max-height: 300px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            color: white;
            background: #f59e0b; /* default pending */
        }
        .status-ongoing { background: #10b981; }
        .status-done { background: #3b82f6; }
        .status-checkout { background: #6b7280; }
        .status-cancelled { background: #ef4444; }
        .status-refund { background: #8b5cf6; }
    </style>
</head>
<body>

    <div class="header">
        <h1>STAYEASE HOTEL</h1>
        <p>Bukti Reservasi & Check-in Tamu</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <tr>
            <th>Status Reservasi</th>
            <td>
                @php
                    $statusClass = '';
                    switch($detail->status) {
                        case 'ongoing': $statusClass = 'status-ongoing'; break;
                        case 'done': $statusClass = 'status-done'; break;
                        case 'checkout': $statusClass = 'status-checkout'; break;
                        case 'cancelled': $statusClass = 'status-cancelled'; break;
                        case 'refund': $statusClass = 'status-refund'; break;
                    }
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ strtoupper($detail->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <th>ID Pemesanan</th>
            <td>#RES-{{ str_pad($detail->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
    </table>

    <div class="section-title">Data Diri Tamu</div>
    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $detail->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $detail->nik }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $detail->email }}</td>
        </tr>
        <tr>
            <th>No. WhatsApp</th>
            <td>{{ $detail->whatsapp }}</td>
        </tr>
    </table>

    @if($detail->nama_tamu_lain)
    @php
        $namaTamuLain = json_decode($detail->nama_tamu_lain, true);
        $nikTamuLain = json_decode($detail->nik_tamu_lain, true);
        if (!is_array($namaTamuLain)) {
            $namaTamuLain = [$detail->nama_tamu_lain];
            $nikTamuLain = [$detail->nik_tamu_lain];
        }
    @endphp
    <div class="section-title">Data Tamu Lain</div>
    <table>
        @foreach($namaTamuLain as $index => $nama)
        <tr>
            <th>Tamu Tambahan {{ $index + 1 }}</th>
            <td>{{ $nama }} (NIK: {{ $nikTamuLain[$index] ?? '-' }})</td>
        </tr>
        @endforeach
    </table>
    @endif

    <div class="section-title">Detail Pemesanan Kamar</div>
    <table>
        <tr>
            <th>Tipe Kamar</th>
            <td>{{ $detail->room_type }}</td>
        </tr>
        <tr>
            <th>Nomor Kamar</th>
            <td>{{ $detail->room_number ?? '-' }}</td>
        </tr>
        <tr>
            <th>Check-in / Check-out</th>
            <td>{{ $detail->check_in_out }}</td>
        </tr>
        <tr>
            <th>Jumlah Tamu</th>
            <td>{{ $detail->jumlah_tamu }} Orang</td>
        </tr>
        <tr>
            <th>Total Pembayaran</th>
            <td><strong>Rp {{ number_format($detail->total_biaya, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td>{{ strtoupper($detail->payment_method) }}</td>
        </tr>
        <tr>
            <th>Permintaan Khusus</th>
            <td>{{ $detail->permintaan_khusus ?? '-' }}</td>
        </tr>
    </table>

    @if($base64Image)
    <div class="section-title">Bukti Pembayaran</div>
    <div class="bukti-container">
        <img src="{{ $base64Image }}" alt="Bukti Pembayaran">
    </div>
    @endif

    <div class="footer">
        <p>Dokumen ini adalah bukti resmi reservasi dari Sistem StayEase Hotel.</p>
        <p>Harap tunjukkan dokumen ini saat Check-in jika diperlukan.</p>
    </div>

</body>
</html>
