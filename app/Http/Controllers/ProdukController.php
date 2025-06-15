<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();

        return view('product', compact('produkList'), ['title' => 'Product Page']);
    }

    public function adminindex()
    {
        $produkList = Produk::all();

        return view('admin.produk.index', compact('produkList'), ['title' => 'Admin Product Page']);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail', compact('produk'), ['title' => 'Product Page']);
    }

    public function create()
    {
        return view('admin.produk.tambah', ['title' => 'Create Product Page']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|string|max:255|unique:produk,kode_produk',
            'nama_produk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kuantitas_produk' => 'required|integer|min:0',
            'satuan' => 'required|string|in:gram,ml',
            'harga_jual' => 'required|numeric|min:0',
            'harga_produksi' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Produk::create($validated);

        // return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'), ['title' => 'Edit Product Page']);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'stok_akhir' => 'required|integer|min:0',
            'kuantitas_produk' => 'required|integer|min:0',
            'satuan' => 'required|string|in:gram,ml',
            'harga_jual' => 'required|numeric|min:0',
            'harga_produksi' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $produk->update($validated);

        return redirect()->route('index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('index')->with('success', 'Produk berhasil dihapus.');
    }
}
