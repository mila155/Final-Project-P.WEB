<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>{{ $title }}</x-slot:title> 

    <div class="container mx-auto my-10 pb-10 px-4">
        <div class="my-20">
            <h3 class="text-center text-2xl font-bold">Produk Kami</h3>
            <p class="text-center mb-6">Hadirkan camilan sehat dan lezat dalam keseharianmu!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($produkList as $produk)
                @php
                    $satuan = Str::contains($produk->nama_produk, 'Susu') ? 'ml' : 'gram';
                @endphp

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset($produk->foto) }}" class="w-full h-48 object-contain" alt="{{ $produk->nama_produk }}">
                    <div class="p-4">
                        <h5 class="font-bold">
                            {{ $produk->nama_produk }}
                        </h5>
                        <p class="text-green-600 font-bold">
                            Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                        </p>
                        {{-- <p>
                            Berat: {{ $produk->kuantitas_produk }} {{ $satuan }}
                        </p> --}}
                        {{-- @if ($produk->stok_akhir<6)                             --}}
                        @if ($produk->stok<6)                            
                            <p class="text-red-700">
                                {{-- Stok: {{ $produk->stok_akhir }} pcs --}}
                                Stok tersisa sedikit!
                            </p>
                        @endif

                        {{-- @if (session('error'))
                            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif --}}
                        
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kode_produk" value="{{ $produk->kode_produk }}">
                            <input type="hidden" name="nama" value="{{ $produk->nama_produk }}">
                            <input type="hidden" name="harga" value="{{ $produk->harga_jual }}">
                            {{-- @if ($produk->stok_akhir) --}}
                            @if ($produk->stok)
                                <input type="hidden" name="jumlah" value=1>                               
                            @else
                            @endif
                            <button type="submit" class="mt-4 inline-block bg-green-500 text-white p-2 rounded hover:bg-blue-600">
                                Tambah ke keranjang
                            </button>
                        </form>
                        <a href="{{ route('detail', $produk->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        </script>
    @endif

</x-layout>