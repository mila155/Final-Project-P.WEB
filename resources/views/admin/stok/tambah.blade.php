<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title> 

    <div class="bg-green-700 sticky top-0 shadow-md z-[1030]">
        <nav class="container mx-auto flex items-center justify-center p-4">
            <a href="{{ route('admin') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kembali</a>
            <a href="{{ route('stok.create') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Tambah Stok</a>
            <a href="{{ route('stok.history') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Histori</a>
            <a href="{{ route('stok.report') }}" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Laporan Manajemen</a>
        </nav>
    </div>
    <div class="max-w-4xl my-10 mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Tambah Stok Masuk</h1>
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('stok.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" required class="w-full border rounded px-3 py-2" value="{{ old('tanggal_masuk') }}" />
                @error('tanggal_masuk')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block font-semibold">Pilih Produk</label>
                <select name="kode_produk" required class="w-full border rounded px-3 py-2">
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->kode_produk }}" {{ old('kode_produk') == $produk->kode_produk ? 'selected' : '' }}>
                            {{ $produk->kode_produk }} - {{ $produk->nama_produk }}
                        </option>
                    @endforeach
                </select>
                @error('kode_produk')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block font-semibold">Jumlah Masuk</label>
                <input type="number" name="jumlah_masuk" required class="w-full border rounded px-3 py-2" min="1"/>
                @error('jumlah_masuk')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" onclick="this.disabled=true; this.form.submit();" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                {{-- <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button> --}}
            </div>
        </form>
    </div>
</x-layout>