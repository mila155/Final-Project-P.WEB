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
        // $tanggal_awal = $request->query('tanggal_awal');
        // $tanggal_akhir = $request->query('tanggal_akhir');
        $tanggal_awal = $request->query('tanggal_awal', now()->subDays(30)->toDateString());
        $tanggal_akhir = $request->query('tanggal_akhir', now()->toDateString());

        $query = Produk::select(
            'produk.kode_produk',
            'produk.nama_produk',
            'produk.stok as stok_db',
            DB::raw('COALESCE(SUM(sm.jumlah_masuk), 0) as total_masuk'),
            DB::raw('COALESCE(SUM(sk.jumlah_keluar), 0) as total_keluar'),
            DB::raw('MAX(sm.tanggal_masuk) as tanggal_terakhir_masuk')
        )
            // ->leftJoin('stok_masuk as sm', function ($join) use ($tanggal_awal, $tanggal_akhir) {
            //     $join->on('produk.kode_produk', '=', 'sm.kode_produk');
            //     if ($tanggal_awal && $tanggal_akhir) {
            //         $join->whereBetween('sm.tanggal_masuk', [$tanggal_awal, $tanggal_akhir]);
            //     }
            // })
            ->leftJoin('stok_masuk as sm', function ($join) use ($tanggal_awal, $tanggal_akhir) {
                $join->on('produk.kode_produk', '=', 'sm.kode_produk')
                    ->whereBetween('sm.tanggal_masuk', [$tanggal_awal, $tanggal_akhir]);
            })
            // ->leftJoin('stok_keluar as sk', function ($join) use ($tanggal_awal, $tanggal_akhir) {
            //     $join->on('produk.kode_produk', '=', 'sk.kode_produk');
            //     if ($tanggal_awal && $tanggal_akhir) {
            //         $join->whereBetween('sk.tanggal_keluar', [$tanggal_awal, $tanggal_akhir]);
            //     }
            // })
            ->leftJoin('stok_keluar as sk', function ($join) use ($tanggal_awal, $tanggal_akhir) {
                $join->on('produk.kode_produk', '=', 'sk.kode_produk')
                    ->whereBetween('sk.tanggal_keluar', [$tanggal_awal, $tanggal_akhir]);
            })
            ->groupBy('produk.kode_produk', 'produk.nama_produk', 'produk.stok')
            ->havingRaw('total_masuk > 0 OR total_keluar > 0');

        // if ($tanggal_awal && $tanggal_akhir) {
        //     $query->havingRaw('total_masuk > 0 OR total_keluar > 0');
        // }

        $stokReports = $query->get()->map(function ($item) {
            // $item->stok_akhir = $item->stok_awal_db + $item->total_masuk - $item->total_keluar;
            $item->stok = $item->stok_db + $item->total_masuk;
            $item->stok_awal = $item->stok_db + $item->total_keluar;
            Produk::where('kode_produk', $item->kode_produk)->update(['stok' => $item->stok]);
            // Produk::where('kode_produk', $item->kode_produk)->update(['stok_akhir' => $item->stok_akhir]);
            return $item;
        });
        dd($stokReports);

        return view('admin.stok.report', compact('stokReports', 'tanggal_awal', 'tanggal_akhir'), ['title' => 'Laporan Manajemen Stok']);
    }

    public function exportPdf(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $query = Produk::select(
            'produk.kode_produk',
            'produk.nama_produk',
            'produk.stok as stok_db',
            DB::raw('COALESCE(SUM(sm.jumlah_masuk), 0) as total_masuk'),
            DB::raw('COALESCE(SUM(sk.jumlah_keluar), 0) as total_keluar'),
            DB::raw('MAX(sm.tanggal_masuk) as tanggal_terakhir_masuk')
        )
            ->leftJoin('stok_masuk as sm', function ($join) use ($tanggal_awal, $tanggal_akhir) {
                $join->on('produk.kode_produk', '=', 'sm.kode_produk');
                if ($tanggal_awal && $tanggal_akhir) {
                    $join->whereBetween('sm.tanggal_masuk', [$tanggal_awal, $tanggal_akhir]);
                }
            })
            ->leftJoin('stok_keluar as sk', function ($join) use ($tanggal_awal, $tanggal_akhir) {
                $join->on('produk.kode_produk', '=', 'sk.kode_produk');
                if ($tanggal_awal && $tanggal_akhir) {
                    $join->whereBetween('sk.tanggal_keluar', [$tanggal_awal, $tanggal_akhir]);
                }
            })
            ->groupBy('produk.kode_produk', 'produk.nama_produk', 'produk.stok');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->havingRaw('total_masuk > 0 OR total_keluar > 0');
        }

        $stokReports = $query->get()->map(function ($item) {
            // $item->stok_akhir = $item->stok_awal_db + $item->total_masuk - $item->total_keluar;
            $item->stok = $item->stok_db + $item->total_masuk - $item->total_keluar;
            return $item;
        });

        $pdf = Pdf::loadView('admin.stok.pdf', compact('stokReports', 'tanggal_awal', 'tanggal_akhir'));
        return $pdf->download('laporan_stok.pdf');
    }
}
