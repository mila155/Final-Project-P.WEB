<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders_total = DB::table('pesanan')->count();
        $orders_new = DB::table('pesanan')
            ->where('tanggal', '>=', now()->subDays(7))
            ->count();
        $total_earning = DB::table('pesanan_detail')
            ->select(DB::raw('SUM(harga * jumlah) as total'))
            ->value('total');

        $lineData = DB::table('pesanan')
            ->selectRaw('DATE(tanggal) as tanggal, COUNT(*) as jumlah')
            ->where('tanggal', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->get();

        $barData = DB::table('pesanan')
            ->join('pesanan_detail', 'pesanan.id', '=', 'pesanan_detail.pesanan_id')
            ->selectRaw('WEEK(tanggal) as minggu, SUM(harga * jumlah) as total')
            ->where('tanggal', '>=', now()->subMonth())
            ->groupBy(DB::raw('WEEK(tanggal)'))
            ->get();

        $omzetData = DB::table('pesanan as p')
            ->join('pesanan_detail as pd', 'p.id', '=', 'pd.pesanan_id')
            ->selectRaw("DATE_FORMAT(p.tanggal, '%Y-%m') AS bulan, SUM(pd.harga * pd.jumlah) AS total_omzet")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $produkData = DB::table('pesanan_detail')
            ->join('produk', 'pesanan_detail.kode_produk', '=', 'produk.kode_produk')
            ->select('produk.nama_produk', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('admin.admin', [
            'orders_total' => $orders_total,
            'orders_new' => $orders_new,
            'total_earning' => $total_earning,
            'lineData' => $lineData,
            'barData' => $barData,
            'omzetData' => $omzetData,
            'produkData' => $produkData,
        ], ['title' => 'Admin Page']);
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'superadmin') {
                return redirect()->route('admin')->with('error', 'Akses ditolak! Halaman ini hanya untuk Superadmin.');
            }
            return $next($request);
        })->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    

    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins.index', compact('admins'), ['title' => 'Kelola Admin']);
    }

    public function create()
    {
        return view('admin.admins.tambah', ['title' => 'Tambah Admin']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email',
            'user_password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'user_name' => $validated['user_name'],
            'user_email' => $validated['user_email'],
            'user_password' => Hash::make($validated['user_password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'admin') {
            return redirect()->route('admins.index')->with('error', 'Admin tidak ditemukan.');
        }
        return view('admin.admins.edit', compact('user'), ['title' => 'Edit Admin']);
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'admin') {
            return redirect()->route('admins.index')->with('error', 'Admin tidak ditemukan.');
        }

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email,' . $user->user_id . ',user_id',
        ]);

        $user->update($validated);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'admin') {
            return redirect()->route('admins.index')->with('error', 'Admin tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus.');
    }
}