<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();

        return view('product', compact('produkList'), ['title' => 'Product Page']);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail', compact('produk'), ['title' => 'Product Page']);
    }
}
