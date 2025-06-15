<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\StokMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class KeuanganController extends Controller
{
    // Method untuk mendapatkan daftar bulan
    private function getBulanList()
    {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    }

    public function index(Request $request)
    {
        $bulan = (int) $request->get('bulan', date('m'));
        $tahun = (int) $request->get('tahun', date('Y'));
        $jenis = $request->get('jenis', 'semua');
        $urutan = $request->get('urutan', 'desc');

        // Data Pemasukan dari Pesanan
        $pemasukan = Pesanan::with('pesanan_details')
            ->byMonth($bulan, $tahun)
            ->orderBy('tanggal', $urutan)
            ->get()
            ->map(function($item) {
                // Hitung total harga dari detail pesanan
                $totalHarga = $item->pesanan_details->sum(function($detail) {
                    return $detail->harga * $detail->jumlah;
                });
                
                return [
                    'tanggal' => $item->tanggal,
                    'kode' => 'PES-' . $item->id,
                    'deskripsi' => 'Pesanan dari ' . ($item->nama ?? 'Customer'),
                    'jenis' => 'pemasukan',
                    'jumlah' => $totalHarga,
                    'kategori' => 'Penjualan'
                ];
            });

        // Data Pengeluaran dari Stok Masuk
        $pengeluaran = StokMasuk::with('produk')
            ->byMonth($bulan, $tahun)
            ->orderBy('tanggal_masuk', $urutan)
            ->get()
            ->map(function($item) {
                // Estimasi harga berdasarkan harga jual produk
                $hargaSatuan = $item->produk->harga_jual ?? 50000; // Default jika tidak ada harga
                $totalHarga = $item->jumlah_masuk * ($hargaSatuan * 0.7); // Estimasi harga beli 70% dari harga jual
                
                return [
                    'tanggal' => $item->tanggal_masuk,
                    'kode' => 'STK-' . $item->id_masuk,
                    'deskripsi' => 'Pembelian stok ' . ($item->produk->nama_produk ?? 'Produk') . ' (' . $item->jumlah_masuk . ' unit)',
                    'jenis' => 'pengeluaran',
                    'jumlah' => $totalHarga,
                    'kategori' => 'Pembelian Stok'
                ];
            });

        // Gabungkan data sesuai filter jenis
        $transaksi = collect();
        
        if ($jenis === 'semua') {
            $transaksi = $pemasukan->concat($pengeluaran);
        } elseif ($jenis === 'pemasukan') {
            $transaksi = $pemasukan;
        } elseif ($jenis === 'pengeluaran') {
            $transaksi = $pengeluaran;
        }

        // Urutkan gabungan data
        $transaksi = $transaksi->sortBy(function($item) use ($urutan) {
            return $urutan === 'desc' ? -strtotime($item['tanggal']) : strtotime($item['tanggal']);
        });

        // Pagination manual
        $perPage = 15;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $totalItems = $transaksi->count();
        $transaksiPaginated = $transaksi->slice($offset, $perPage)->values();

        // Buat pagination object
        $transaksiPagination = new LengthAwarePaginator(
            $transaksiPaginated,
            $totalItems,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'pageName' => 'page'
            ]
        );

        // Hitung total
        $totalPemasukan = Pesanan::with('pesanan_details')
            ->byMonth($bulan, $tahun)
            ->get()
            ->sum(function($pesanan) {
                return $pesanan->pesanan_details->sum(function($detail) {
                    return $detail->harga * $detail->jumlah;
                });
            });

        $totalPengeluaran = StokMasuk::with('produk')
            ->byMonth($bulan, $tahun)
            ->get()
            ->sum(function($item) {
                $hargaSatuan = $item->produk->harga_jual ?? 50000;
                return $item->jumlah_masuk * ($hargaSatuan * 0.7);
            });
        
        $keuntunganBersih = $totalPemasukan - $totalPengeluaran;

        // Data untuk dropdown
        $bulanList = $this->getBulanList();
        $tahunList = range(date('Y') - 5, date('Y') + 1);

        return view('keuangan', [
            'transaksi' => $transaksiPagination,
            'bulanList' => $bulanList,
            'tahunList' => $tahunList,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenis' => $jenis,
            'urutan' => $urutan,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'keuntunganBersih' => $keuntunganBersih
        ]);
    }

    public function exportPdf(Request $request)
    {
        $bulan = (int) $request->get('bulan', date('m'));
        $tahun = (int) $request->get('tahun', date('Y'));
        $jenis = $request->get('jenis', 'semua');

        // Ambil data pemasukan
        $pemasukan = Pesanan::with('pesanan_details')->byMonth($bulan, $tahun)->get();
        
        // Ambil data pengeluaran
        $pengeluaran = StokMasuk::with('produk')->byMonth($bulan, $tahun)->get();

        // Gabungkan data
        $transaksi = collect();
        
        if ($jenis === 'semua' || $jenis === 'pemasukan') {
            $dataPemasukan = $pemasukan->map(function($item) {
                $totalHarga = $item->pesanan_details->sum(function($detail) {
                    return $detail->harga * $detail->jumlah;
                });
                
                return [
                    'tanggal' => $item->tanggal,
                    'kode' => 'PES-' . $item->id,
                    'deskripsi' => 'Pesanan dari ' . ($item->nama ?? 'Customer'),
                    'jenis' => 'pemasukan',
                    'jumlah' => $totalHarga
                ];
            });
            $transaksi = $transaksi->concat($dataPemasukan);
        }

        if ($jenis === 'semua' || $jenis === 'pengeluaran') {
            $dataPengeluaran = $pengeluaran->map(function($item) {
                $hargaSatuan = $item->produk->harga_jual ?? 50000;
                $totalHarga = $item->jumlah_masuk * ($hargaSatuan * 0.7);
                
                return [
                    'tanggal' => $item->tanggal_masuk,
                    'kode' => 'STK-' . $item->id_masuk,
                    'deskripsi' => 'Pembelian stok ' . ($item->produk->nama_produk ?? 'Produk') . ' (' . $item->jumlah_masuk . ' unit)',
                    'jenis' => 'pengeluaran',
                    'jumlah' => $totalHarga
                ];
            });
            $transaksi = $transaksi->concat($dataPengeluaran);
        }

        // Urutkan berdasarkan tanggal
        $transaksi = $transaksi->sortByDesc('tanggal');

        $bulanList = $this->getBulanList();

        $totalPemasukan = $pemasukan->sum(function($pesanan) {
            return $pesanan->pesanan_details->sum(function($detail) {
                return $detail->harga * $detail->jumlah;
            });
        });

        $totalPengeluaran = $pengeluaran->sum(function($item) {
            $hargaSatuan = $item->produk->harga_jual ?? 50000;
            return $item->jumlah_masuk * ($hargaSatuan * 0.7);
        });

        $pdf = PDF::loadView('keuangan-pdf', compact(
            'transaksi', 'bulan', 'tahun', 'jenis', 'bulanList',
            'totalPemasukan', 'totalPengeluaran'
        ));

        $filename = "laporan-keuangan-{$bulanList[$bulan]}-{$tahun}.pdf";
        return $pdf->download($filename);
    }

    public function exportExcel(Request $request)
    {
        $bulan = (int) $request->get('bulan', date('m'));
        $tahun = (int) $request->get('tahun', date('Y'));
        $jenis = $request->get('jenis', 'semua');

        // Ambil data pemasukan
        $pemasukan = Pesanan::with('pesanan_details')->byMonth($bulan, $tahun)->get();
        
        // Ambil data pengeluaran
        $pengeluaran = StokMasuk::with('produk')->byMonth($bulan, $tahun)->get();

        $bulanList = $this->getBulanList();

        // Generate CSV content
        $csvContent = "Tanggal,Kode,Deskripsi,Jenis,Jumlah\n";
        
        // Tambah data pemasukan
        if ($jenis === 'semua' || $jenis === 'pemasukan') {
            foreach ($pemasukan as $item) {
                $totalHarga = $item->pesanan_details->sum(function($detail) {
                    return $detail->harga * $detail->jumlah;
                });
                
                $csvContent .= sprintf(
                    "%s,PES-%s,\"%s\",Pemasukan,%s\n",
                    $item->tanggal->format('d/m/Y'),
                    $item->id,
                    'Pesanan dari ' . ($item->nama ?? 'Customer'),
                    $totalHarga
                );
            }
        }

        // Tambah data pengeluaran
        if ($jenis === 'semua' || $jenis === 'pengeluaran') {
            foreach ($pengeluaran as $item) {
                $hargaSatuan = $item->produk->harga_jual ?? 50000;
                $totalHarga = $item->jumlah_masuk * ($hargaSatuan * 0.7);
                
                $csvContent .= sprintf(
                    "%s,STK-%s,\"%s\",Pengeluaran,%s\n",
                    $item->tanggal_masuk->format('d/m/Y'),
                    $item->id_masuk,
                    'Pembelian stok ' . ($item->produk->nama_produk ?? 'Produk') . ' (' . $item->jumlah_masuk . ' unit)',
                    $totalHarga
                );
            }
        }

        // Pastikan bulan adalah integer untuk mengakses array
        $namaBulan = isset($bulanList[$bulan]) ? $bulanList[$bulan] : 'Unknown';
        $filename = "laporan-keuangan-{$namaBulan}-{$tahun}.csv";
        
        return response($csvContent)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }
}