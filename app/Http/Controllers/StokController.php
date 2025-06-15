<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    public function history(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $date_filter = $request->query('date_filter', 'newest');

        $query = null;

        if ($filter == 'masuk') {
            $query = StokMasuk::select('stok_masuk.tanggal_masuk as tanggal', 'stok_masuk.kode_produk', 'produk.nama_produk', 'stok_masuk.jumlah_masuk as jumlah')
                ->selectRaw("'masuk' as jenis")
                ->join('produk', 'stok_masuk.kode_produk', '=', 'produk.kode_produk');
        } elseif ($filter == 'keluar') {
            $query = StokKeluar::select('stok_keluar.tanggal_keluar as tanggal', 'stok_keluar.kode_produk', 'produk.nama_produk', 'stok_keluar.jumlah_keluar as jumlah')
                ->selectRaw("'keluar' as jenis")
                ->join('produk', 'stok_keluar.kode_produk', '=', 'produk.kode_produk');
        } else {
            $query = StokMasuk::select('stok_masuk.tanggal_masuk as tanggal', 'stok_masuk.kode_produk', 'produk.nama_produk', 'stok_masuk.jumlah_masuk as jumlah')
                ->selectRaw("'masuk' as jenis")
                ->join('produk', 'stok_masuk.kode_produk', '=', 'produk.kode_produk')
                ->union(
                    StokKeluar::select('stok_keluar.tanggal_keluar as tanggal', 'stok_keluar.kode_produk', 'produk.nama_produk', 'stok_keluar.jumlah_keluar as jumlah')
                        ->selectRaw("'keluar' as jenis")
                        ->join('produk', 'stok_keluar.kode_produk', '=', 'produk.kode_produk')
                );
        }

        $stokHistory = $query->orderBy('tanggal', $date_filter == 'oldest' ? 'asc' : 'desc')->get();

        return view('admin.stok.histori', compact('stokHistory', 'filter', 'date_filter'), ['title' => 'Histori Stok']);
    }

    public function create()
    {
        $produks = Produk::select('kode_produk', 'nama_produk')->get();
        return view('admin.stok.tambah', compact('produks'), ['title' => 'Tambah Stok Masuk']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_masuk' => 'required|date',
            'kode_produk' => 'required|exists:produk,kode_produk',
            'jumlah_masuk' => 'required|integer|min:1',
        ]);

        StokMasuk::create([
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'kode_produk' => $validated['kode_produk'],
            'jumlah_masuk' => $validated['jumlah_masuk'],
        ]);

        return redirect()->route('stok.history')->with('success', 'Stok masuk berhasil ditambahkan.');
    }

    public function report(Request $request)
    {
        $tanggal_awal = $request->query('tanggal_awal', now()->subDays(30)->toDateString());
        $tanggal_akhir = $request->query('tanggal_akhir', now()->toDateString());

        $stokMasukSub = DB::table('stok_masuk')
            ->select('kode_produk', DB::raw('SUM(jumlah_masuk) as total_masuk'), DB::raw('MAX(tanggal_masuk) as tanggal_terakhir_masuk'))
            ->whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('kode_produk');

        $stokKeluarSub = DB::table('stok_keluar')
            ->select('kode_produk', DB::raw('SUM(jumlah_keluar) as total_keluar'))
            ->whereBetween('tanggal_keluar', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('kode_produk');

        $query = Produk::select(
            'produk.kode_produk',
            'produk.nama_produk',
            'produk.stok as stok_awal_db',
            DB::raw('COALESCE(sm.total_masuk, 0) as total_masuk'),
            DB::raw('COALESCE(sk.total_keluar, 0) as total_keluar'),
            DB::raw('COALESCE(sm.tanggal_terakhir_masuk, NULL) as tanggal_terakhir_masuk')            
        )
            ->leftJoinSub($stokMasukSub, 'sm', function ($join) {
                $join->on('produk.kode_produk', '=', 'sm.kode_produk');
            })
            ->leftJoinSub($stokKeluarSub, 'sk', function ($join) {
                $join->on('produk.kode_produk', '=', 'sk.kode_produk');
            })
            ->havingRaw('total_masuk > 0 OR total_keluar > 0');

        $stokReports = $query->get()->map(function ($item) {
            $item->stok_akhir = $item->stok_awal_db - $item->total_keluar + $item->total_masuk ;
            Produk::where('kode_produk', $item->kode_produk)->update(['stok_akhir' => $item->stok_akhir]);
            return $item;
        });
        
        return view('admin.stok.report', compact('stokReports', 'tanggal_awal', 'tanggal_akhir'), ['title' => 'Laporan Manajemen Stok']);
    }

    public function exportPdf(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $stokMasukSub = DB::table('stok_masuk')
            ->select('kode_produk', DB::raw('SUM(jumlah_masuk) as total_masuk'), DB::raw('MAX(tanggal_masuk) as tanggal_terakhir_masuk'))
            ->whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('kode_produk');

        $stokKeluarSub = DB::table('stok_keluar')
            ->select('kode_produk', DB::raw('SUM(jumlah_keluar) as total_keluar'))
            ->whereBetween('tanggal_keluar', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('kode_produk');

        $query = Produk::select(
            'produk.kode_produk',
            'produk.nama_produk',
            'produk.stok as stok_awal_db',
            DB::raw('COALESCE(sm.total_masuk, 0) as total_masuk'),
            DB::raw('COALESCE(sk.total_keluar, 0) as total_keluar'),
            DB::raw('COALESCE(sm.tanggal_terakhir_masuk, NULL) as tanggal_terakhir_masuk')
        )
        ->leftJoinSub($stokMasukSub, 'sm', function ($join) {
            $join->on('produk.kode_produk', '=', 'sm.kode_produk');
        })
        ->leftJoinSub($stokKeluarSub, 'sk', function ($join) {
            $join->on('produk.kode_produk', '=', 'sk.kode_produk');
        })
        ->havingRaw('total_masuk > 0 OR total_keluar > 0');

        $stokReports = $query->get()->map(function ($item) {
            $item->stok_akhir = $item->stok_awal_db + $item->total_masuk - $item->total_keluar;
            return $item;
        });

        $pdf = Pdf::loadView('admin.stok.pdf', compact('stokReports', 'tanggal_awal', 'tanggal_akhir'));
        return $pdf->download('laporan_stok.pdf');
    }
}
