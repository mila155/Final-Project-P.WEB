<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Manajemen Stok</title>
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
        <div class="report-title">LAPORAN MANAJEMEN STOK</div>
        <div class="report-period">
            Periode: {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
        </div>
    </div>

    <!-- Stock Table -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Produk</th>
                <th width="25%">Nama Produk</th>
                <th width="10%">Stok Awal</th>
                <th width="10%">Masuk</th>
                <th width="10%">Keluar</th>
                <th width="10%">Stok Akhir</th>
                <th width="15%">Tgl Masuk Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($stokReports) && $stokReports->count() > 0)
                @foreach($stokReports as $index => $data)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $data->kode_produk }}</td>
                    <td>{{ $data->nama_produk }}</td>
                    <td class="text-center">{{ $data->stok_awal_db }}</td>
                    <td class="text-center">{{ $data->total_masuk }}</td>
                    <td class="text-center">{{ $data->total_keluar }}</td>
                    <td class="text-center">{{ $data->stok_akhir }}</td>
                    <td class="text-center">
                        {{ $data->tanggal_terakhir_masuk ? \Carbon\Carbon::parse($data->tanggal_terakhir_masuk)->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="no-data">
                        Tidak ada data stok untuk periode yang dipilih
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan digenerate pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>&copy; {{ date('Y') }} Cemal Cemil - Sistem Manajemen Stok</p>
    </div>
</body>
</html>