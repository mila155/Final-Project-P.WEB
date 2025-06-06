<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alata&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Geist:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Sofia+Sans+Semi+Condensed:ital,wght@0,1..1000;1,1..1000&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
    </style>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Detail Produk - {{ $produk->nama_produk }}</title>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <x-navbar></x-navbar>

    <div class="container mx-auto my-10 py-10 px-4">
        <div class="flex flex-col md:flex-row g-3 items-center"> 
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset($produk->foto) }}" class="w-full h-64 object-contain" alt="{{ $produk->nama_produk }}">
            </div>
            <div class="md:w-1/2 p-4">
                <h2 class="font-bold text-2xl mb-2">{{ $produk->nama_produk }}</h2>
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

    <x-footer></x-footer>
</body>
</html>