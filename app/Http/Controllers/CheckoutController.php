<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Produk;
use App\Models\StokKeluar;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $userId = Auth::id();
        $keranjang = Keranjang::where('user_id', $userId)->get();
        $totalBayar = $keranjang->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('checkout', compact('keranjang', 'totalBayar') + ['title' => 'Checkout Page']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
        ]);

        $userId = Auth::id(); 

        $keranjang = Keranjang::where('user_id', $userId)->get();

        $pesanan = Pesanan::create([
            'id_user' => $userId,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'tanggal' => now(),
        ]);

        foreach ($keranjang as $item) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'kode_produk' => $item->kode_produk,
                'harga' => $item->harga,
                'jumlah' => $item->jumlah,
            ]);

            $produk = Produk::find($item->kode_produk);

            StokKeluar::create([
                // 'kode_produk' => $produk->kode_produk,
                'kode_produk' => $item->kode_produk,
                // 'tanggal_keluar' => Carbon::now()->format('Y-m-d'),
                'tanggal_keluar' => now(),
                'jumlah_keluar' => $item->jumlah,
                'pesanan_id' => $pesanan->id,
            ]);
        }

        Keranjang::where('user_id', $userId)->delete(); 

        return redirect('/')->with('success', 'Pesanan berhasil dilakukan!');
    }
}
