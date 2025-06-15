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
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Stok Produk</h2>
        <form method="GET" action="{{ route('stok.report') }}?v={{ time() }}" class="mb-6 flex justify-center space-x-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                {{-- <input type="date" name="tanggal_awal" class="border rounded px-2 py-1" value="{{ $tanggal_awal }}"> --}}
                <input type="date" name="tanggal_awal" class="border rounded px-2 py-1" value="{{ $tanggal_awal ?? now()->subDays(30)->format('Y-m-d') }}" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                {{-- <input type="date" name="tanggal_akhir" class="border rounded px-2 py-1" value="{{ $tanggal_akhir }}"> --}}
                <input type="date" name="tanggal_akhir" class="border rounded px-2 py-1" value="{{ $tanggal_akhir ?? now()->format('Y-m-d') }}" required>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Filter</button>
            </div>
        </form>
        <form action="{{ route('stok.exportPdf') }}" method="POST" target="_blank" class="flex justify-center mb-4">
            @csrf
            <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
            <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500">Export PDF</button>
        </form>
        <div class="overflow-x-auto">
            <table class="table-auto mt-4 w-full border-collapse border">
                <thead>
                    <tr class="bg-green-300">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Kode Produk</th>
                        <th class="border px-4 py-2">Nama Produk</th>
                        <th class="border px-4 py-2">Stok Awal</th>
                        <th class="border px-4 py-2">Masuk</th>
                        <th class="border px-4 py-2">Keluar</th>
                        <th class="border px-4 py-2">Stok Akhir</th>
                        <th class="border px-4 py-2">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stokReports as $index => $data)
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ htmlspecialchars($data->kode_produk) }}</td>
                            <td class="border px-4 py-2">{{ htmlspecialchars($data->nama_produk) }}</td>
                            {{-- <td class="border px-4 py-2">{{ $data->stok_awal_db }}</td> --}}
                            <td class="border px-4 py-2">{{ $data->stok_awal }}</td>
                            <td class="border px-4 py-2">{{ $data->total_masuk }}</td>
                            <td class="border px-4 py-2">{{ $data->total_keluar }}</td>
                            {{-- <td class="border px-4 py-2">{{ $data->stok_akhir }}</td> --}}
                            <td class="border px-4 py-2">{{ $data->stok }}</td>
                            <td class="border px-4 py-2">{{ $data->tanggal_terakhir_masuk ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>