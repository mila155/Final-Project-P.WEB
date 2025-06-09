<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class CartController extends Controller
{
    public function index()
    {
        // Ambil semua data keranjang
        $items = Keranjang::all();

        // Bisa hitung grand total di controller (optional)
        $grandTotal = $items->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        // Kirim $items dan $grandTotal ke view
        return view('cart', compact('items', 'grandTotal'), ['title' => 'Cart Page']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|exists:produk,kode_produk',
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::where('kode_produk', $validated['kode_produk'])->first();

        if ($keranjang) {
            // Jika produk sudah ada di keranjang, update jumlahnya
            $keranjang->increment('jumlah', $validated['jumlah']);
        } else {
            // Ambil data produk untuk foto
            $produk = Produk::find($validated['kode_produk']);

            Keranjang::create([
                'kode_produk' => $validated['kode_produk'],
                'nama' => $validated['nama'],
                'harga' => $validated['harga'],
                'jumlah' => $validated['jumlah'],
                'gambar' => $produk->foto,
            ]);
        }

        return redirect()->route('cart');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update(['jumlah' => $validated['jumlah']]);

        return redirect()->route('cart');
    }

    public function destroy($id)
    {
        Keranjang::destroy($id);

        return redirect()->route('cart');
    }
}
