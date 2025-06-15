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
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Stok Produk</h2>
        
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Filter Form -->
        <form method="GET" action="{{ route('stok.report') }}" class="mb-6 flex justify-center space-x-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="border rounded px-2 py-1" value="{{ $tanggal_awal ?? now()->subDays(30)->format('Y-m-d') }}" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="border rounded px-2 py-1" value="{{ $tanggal_akhir ?? now()->format('Y-m-d') }}" required>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Filter</button>
            </div>
        </form>
        
        <!-- Export PDF Form -->
        @if(isset($stokReports) && $stokReports->count() > 0)
        <form action="{{ route('stok.exportPdf') }}" method="POST" class="flex justify-center mb-4">
            @csrf
            <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
            <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500">
                📄 Export PDF
            </button>
        </form>
        @endif
        
        <!-- Data Table -->
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
                    @if(isset($stokReports) && $stokReports->count() > 0)
                        @foreach ($stokReports as $index => $data)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ htmlspecialchars($data->kode_produk) }}</td>
                                <td class="border px-4 py-2">{{ htmlspecialchars($data->nama_produk) }}</td>
                                <td class="border px-4 py-2">{{ $data->stok_awal_db }}</td>
                                <td class="border px-4 py-2">{{ $data->total_masuk }}</td>
                                <td class="border px-4 py-2">{{ $data->total_keluar }}</td>
                                <td class="border px-4 py-2">{{ $data->stok_akhir }}</td>
                                <td class="border px-4 py-2">{{ $data->tanggal_terakhir_masuk ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="border px-4 py-2 text-center text-gray-500">
                                Tidak ada data untuk periode yang dipilih
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>