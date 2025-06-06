<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders_total = DB::table('pesanan')->count();
        $orders_new = DB::table('pesanan')
            ->where('tanggal', '>=', now()->subDays(7))
            ->count();
        $total_earning = DB::table('pesanan_detail')
            ->select(DB::raw('SUM(harga * jumlah) as total'))
            ->value('total');

        // Line chart: pesanan 7 hari terakhir
        $lineData = DB::table('pesanan')
            ->selectRaw('DATE(tanggal) as tanggal, COUNT(*) as jumlah')
            ->where('tanggal', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->get();

        // Bar chart: pendapatan per minggu dalam sebulan terakhir
        $barData = DB::table('pesanan')
            ->join('pesanan_detail', 'pesanan.id', '=', 'pesanan_detail.pesanan_id')
            ->selectRaw('WEEK(tanggal) as minggu, SUM(harga * jumlah) as total')
            ->where('tanggal', '>=', now()->subMonth())
            ->groupBy(DB::raw('WEEK(tanggal)'))
            ->get();

        // Omzet per bulan
        $omzetData = DB::table('pesanan as p')
            ->join('pesanan_detail as pd', 'p.id', '=', 'pd.pesanan_id')
            ->selectRaw("DATE_FORMAT(p.tanggal, '%Y-%m') AS bulan, SUM(pd.harga * pd.jumlah) AS total_omzet")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Produk terlaris
        $produkData = DB::table('pesanan_detail')
            ->join('produk', 'pesanan_detail.kode_produk', '=', 'produk.kode_produk')
            ->select('produk.nama_produk', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('admin', [
            'orders_total' => $orders_total,
            'orders_new' => $orders_new,
            'total_earning' => $total_earning,
            'lineData' => $lineData,
            'barData' => $barData,
            'omzetData' => $omzetData,
            'produkData' => $produkData,
        ]);
    }
}