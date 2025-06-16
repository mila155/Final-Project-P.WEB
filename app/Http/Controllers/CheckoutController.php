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
use Illuminate\Support\Facades\DB;

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

        // return redirect('/')->with('success', 'Pesanan berhasil dilakukan!');
        return redirect()->route('payment.form', ['pesanan_id' => $pesanan->id]);
    }
    public function showPaymentForm($pesanan_id)
    {
        $pesanan = Pesanan::findOrFail($pesanan_id);
        $keranjang = Keranjang::where('user_id', Auth::id())->get();
        $totalBayar = $pesanan->pesanan_details()->sum(DB::raw('harga * jumlah'));

        return view('payment', compact('pesanan', 'keranjang', 'totalBayar') + ['title' => 'Payment Page']);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'metode_pembayaran' => 'required|in:bank_transfer,qris',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pesanan = Pesanan::findOrFail($request->pesanan_id);

        // Handle file upload
        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran', 'public');

        $pesanan->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'pending', // Initial status
        ]);

        return redirect('/')->with('success', 'Pembayaran berhasil dikonfirmasi! Menunggu verifikasi.');
    }
}
