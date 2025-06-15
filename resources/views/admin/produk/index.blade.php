<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title> 

    <div class="max-w-4xl mx-auto bg-green-50 p-6 rounded-lg my-10 py-10 shadow-lg">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Data Produk</h2>
        <div class="mb-3">
            <a href="{{ route('admin') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
            <a href="{{ route('produk.create') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Tambah Produk</a>
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
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-400 text-sm text-left">
                <thead>
                    <tr class="bg-green-300 text-gray-700">
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Kode</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Nama</th>
                        {{-- <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Stok</th> --}}
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Kuantitas</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Satuan Kuantitas</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Harga</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Deskripsi</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="inventoryTable">
                    @foreach ($produkList as $produk)
                        <tr>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->kode_produk }}
                            </td>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->nama_produk }}
                            </td>
                            {{-- <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                @if ($produk->stok_akhir!=null)
                                    {{ $produk->stok_akhir }}
                                @else
                                    {{ $produk->stok }}
                                @endif
                            </td> --}}
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->kuantitas_produk }}
                            </td>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->satuan }}
                            </td>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->harga_jual }}
                            </td>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                {{ $produk->deskripsi ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                                <a href="{{ route('produk.edit', $produk->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>