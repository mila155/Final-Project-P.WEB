<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto my-10 py-10 px-4">
        <div class="flex flex-col md:flex-row g-3 items-center"> 
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset($produk->foto) }}" class="w-full h-64 object-contain" alt="{{ $produk->nama_produk }}">
            </div>
            <div class="md:w-1/2 p-4">
                <h2 class="font-bold text-2xl mb-2">
                    {{ $produk->nama_produk }}
                </h2>
                <p class="mb-2">{{ $produk->deskripsi ?? 'Produk lezat dan menyehatkan untuk menemani harimu.' }}</p>
                <h4 class="text-green-600 font-bold mb-2">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</h4>

                @php
                    $satuan = Str::contains($produk->nama_produk, 'Susu') ? 'ml' : 'gram';
                @endphp

                <p class="mb-1">Berat: {{ $produk->kuantitas_produk }} {{ $satuan }}</p>
                <p class="mb-3">Stok: {{ $produk->stok_akhir }} tersedia</p>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_produk" value="{{ $produk->id }}">
                    <input type="hidden" name="nama" value="{{ $produk->nama_produk }}">
                    <input type="hidden" name="harga" value="{{ $produk->harga_jual }}">
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="number" name="jumlah" id="jumlah" class="border rounded p-2" value="1" min="1" max="{{ $produk->stok_akhir }}">
                        @error('jumlah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Masukkan ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto mb-10">
        <a href="/product" class="bg-gray-300 text-gray-800 py-2 px-4 ml-10 rounded hover:bg-gray-400">
            Kembali ke Katalog
        </a>
    </div>
</x-layout>