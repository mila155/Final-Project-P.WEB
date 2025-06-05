<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();

        return view('product', compact('produkList'));
    }
}
