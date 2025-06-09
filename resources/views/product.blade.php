<x-layout>
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
                        <p>
                            Berat: {{ $produk->kuantitas_produk }} {{ $satuan }}
                        </p>
                        <p>
                            Stok: {{ $produk->stok_akhir }} pcs
                        </p>
                        <a href="{{ route('detail', $produk->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>