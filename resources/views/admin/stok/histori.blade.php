<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title> 

    <div class="bg-green-700 top-0 shadow-md z-[1030]">
        <nav class="container mx-auto flex items-center justify-center p-4">
            <a href="{{ route('admin') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kembali</a>
            <a href="{{ route('stok.create') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Tambah Stok</a>
            <a href="{{ route('stok.history') }}" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Histori</a>
            <a href="{{ route('stok.report') }}" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Laporan Manajemen</a>
        </nav>
    </div>
    <div class="max-w-4xl my-10 mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl flex items-center justify-center font-bold mb-6">Histori Stok</h1>
        <form method="GET" class="mb-4 flex items-center space-x-4">
            <label for="filter" class="text-lg">Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                <option value="semua" {{ $filter == 'semua' ? 'selected' : '' }}>Semua</option>
                <option value="masuk" {{ $filter == 'masuk' ? 'selected' : '' }}>Stok Masuk</option>
                <option value="keluar" {{ $filter == 'keluar' ? 'selected' : '' }}>Stok Keluar</option>
            </select>
            <label for="date_filter" class="text-lg">Tanggal:</label>
            <select name="date_filter" id="date_filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                <option value="newest" {{ $date_filter == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ $date_filter == 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Kode Produk</th>
                        <th class="border px-4 py-2">Nama Produk</th>
                        <th class="border px-4 py-2">Jenis</th>
                        <th class="border px-4 py-2">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stokHistory as $row)
                        <tr class="border-t {{ $row->jenis == 'masuk' ? 'bg-green-100' : 'bg-red-100' }}">
                            <td class="border px-4 py-2">{{ $row->tanggal }}</td>
                            <td class="border px-4 py-2">{{ htmlspecialchars($row->kode_produk) }}</td>
                            <td class="border px-4 py-2">{{ htmlspecialchars($row->nama_produk) }}</td>
                            <td class="border px-4 py-2">
                                <span class="text-white px-2 py-1 items-center justify-center flex rounded text-xs font-semibold {{ $row->jenis == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ strtoupper($row->jenis) }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">{{ $row->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>