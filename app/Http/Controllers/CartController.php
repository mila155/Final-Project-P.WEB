<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            $sessionCart = session()->get('cart', []);

            $items = collect($sessionCart)->map(function ($item, $id) {
                return (object) [
                    'id' => $id,
                    'nama' => $item['name'],
                    'harga' => $item['price'],
                    'jumlah' => $item['quantity'],
                    'gambar' => $item['image'],
                ];
            });

            $grandTotal = $items->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });

            return view('cart', [
                'items' => $items,
                'grandTotal' => $grandTotal,
                'title' => 'Cart Page',
                'notLoggedIn' => true,
            ]);
        }

        $userId = Auth::id();
        $items = Keranjang::where('user_id', $userId)->get();
        $grandTotal = $items->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('cart', compact('items', 'grandTotal') + ['title' => 'Cart Page']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|exists:produk,kode_produk',
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer|min:1',
        ]);
        $produk = Produk::where('kode_produk', $validated['kode_produk'])->first();

        if (Auth::check()) {
            $keranjang = Keranjang::where('kode_produk', $validated['kode_produk'])
                                ->where('user_id', Auth::id())
                                ->first();
            if ($keranjang) {
                // if(($keranjang->jumlah + $validated['jumlah']) <= $produk->stok_akhir){
                if(($keranjang->jumlah + $validated['jumlah']) <= $produk->stok){
                    $keranjang->increment('jumlah', $validated['jumlah']);
                } else {
                    return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');                    
                }
            } else {
                Keranjang::create([
                    'kode_produk' => $validated['kode_produk'],
                    'nama' => $validated['nama'],
                    'harga' => $validated['harga'],
                    'jumlah' => $validated['jumlah'],
                    'gambar' => $produk->foto,
                    'user_id' => Auth::id(),
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            $productId = $produk->kode_produk;

            if (isset($cart[$productId])) {
                // if (($cart[$productId]['quantity'] + $validated['jumlah']) <= $produk->stok_akhir) {
                if (($cart[$productId]['quantity'] + $validated['jumlah']) <= $produk->stok) {
                $cart[$productId]['quantity'] += $validated['jumlah'];
                } else {
                    return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');                    
                }
            } else {
                $cart[$productId] = [
                    'name' => $produk->nama_produk,
                    'price' => $validated['harga'],
                    'quantity' => $validated['jumlah'],
                    'image' => $produk->foto,
                ];
            }

            session()->put('cart', $cart);
        }
         return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);
        $keranjang = Keranjang::findOrFail($id);
        $produk = Produk::where('kode_produk', $keranjang->kode_produk)->first();
        if(($validated['jumlah']) <= $produk->stok_akhir){
                $keranjang->update(['jumlah' => $validated['jumlah']]);
        } else {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');                    
        }        
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Keranjang::destroy($id);
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');;
    }
}
