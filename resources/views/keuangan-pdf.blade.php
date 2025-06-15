<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan - {{ $bulanList[$bulan] }} {{ $tahun }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2d5016;
            margin-bottom: 5px;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .report-period {
            font-size: 14px;
            color: #666;
        }
        .summary {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
        }
        .summary-row:last-child {
            margin-bottom: 0;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            font-weight: bold;
        }
        .summary-label {
            font-weight: bold;
        }
        .summary-value {
            font-weight: bold;
        }
        .pemasukan {
            color: #28a745;
        }
        .pengeluaran {
            color: #dc3545;
        }
        .keuntungan {
            color: #17a2b8;
        }
        .kerugian {
            color: #ffc107;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-name">CEMAL CEMIL</div>
        <div class="report-title">LAPORAN KEUANGAN</div>
        <div class="report-period">
            Periode: {{ $bulanList[$bulan] }} {{ $tahun }}
            @if($jenis != 'semua')
                - {{ ucfirst($jenis) }}
            @endif
        </div>
    </div>

    <!-- Summary -->
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Pemasukan:</span>
            <span class="summary-value pemasukan">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Pengeluaran:</span>
            <span class="summary-value pengeluaran">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Keuntungan Bersih:</span>
            <span class="summary-value {{ ($totalPemasukan - $totalPengeluaran) >= 0 ? 'keuntungan' : 'kerugian' }}">
                Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <!-- Transaction Table -->
    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Kode</th>
                <th width="35%">Deskripsi</th>
                <th width="12%">Jenis</th>
                <th width="18%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($transaksi) && $transaksi->count() > 0)
                @foreach($transaksi as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @if(is_string($item['tanggal']))
                            {{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}
                        @else
                            {{ $item['tanggal']->format('d/m/Y') }}
                        @endif
                    </td>
                    <td>{{ $item['kode'] }}</td>
                    <td>{{ $item['deskripsi'] }}</td>
                    <td class="text-center">
                        <span class="badge {{ $item['jenis'] == 'pemasukan' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($item['jenis']) }}
                        </span>
                    </td>
                    <td class="text-right {{ $item['jenis'] == 'pemasukan' ? 'pemasukan' : 'pengeluaran' }}">
                        {{ $item['jenis'] == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($item['jumlah'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                
                <!-- Total Row -->
                <tr style="background-color: #f8f9fa; font-weight: bold;">
                    <td colspan="5" class="text-right">TOTAL:</td>
                    <td class="text-right">
                        @php
                            $total = 0;
                            foreach($transaksi as $item) {
                                if($item['jenis'] == 'pemasukan') {
                                    $total += $item['jumlah'];
                                } else {
                                    $total -= $item['jumlah'];
                                }
                            }
                        @endphp
                        <span class="{{ $total >= 0 ? 'pemasukan' : 'pengeluaran' }}">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="6" class="no-data">
                        Tidak ada data transaksi untuk periode yang dipilih
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Catatan:</strong></p>
        <p>• Pemasukan: Data diambil dari tabel pesanan berdasarkan total harga detail pesanan</p>
        <p>• Pengeluaran: Data diambil dari tabel stok masuk dengan estimasi 70% dari harga jual produk</p>
        <p>Laporan digenerate pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>&copy; {{ date('Y') }} Cemal Cemil - Sistem Manajemen Keuangan</p>
    </div>
</body>
</html>