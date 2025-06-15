<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>Laporan Keuangan</x-slot:title> 

    <div class="max-w-7xl mx-auto bg-green-50 p-6 rounded-lg my-10 py-10 shadow-lg">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Laporan Keuangan Cemal Cemil</h2>
        
        <!-- Navigation -->
        <div class="mb-3">
            <a href="{{ route('admin') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.keuangan.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan:</label>
                    <select name="bulan" id="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        @foreach($bulanList as $key => $value)
                            <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun:</label>
                    <select name="tahun" id="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        @foreach($tahunList as $year)
                            <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis:</label>
                    <select name="jenis" id="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="semua" {{ $jenis == 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="pemasukan" {{ $jenis == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ $jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan:</label>
                    <select name="urutan" id="urutan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="desc" {{ $urutan == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ $urutan == 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">&nbsp;</label>
                    <button type="submit" class="w-full bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition duration-300">
                        🔍 Filter
                    </button>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Export:</label>
                    <div class="flex space-x-1">
                        <a href="{{ route('admin.keuangan.export.pdf', request()->query()) }}" 
                           class="flex-1 bg-red-600 text-white px-3 py-2 rounded-md text-center text-sm hover:bg-red-700 transition duration-300">
                            📄 PDF
                        </a>
                        <a href="{{ route('admin.keuangan.export.excel', request()->query()) }}" 
                           class="flex-1 bg-green-600 text-white px-3 py-2 rounded-md text-center text-sm hover:bg-green-700 transition duration-300">
                            📊 Excel
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-green-500 text-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">Total Pemasukan</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-3xl">📈</div>
                </div>
            </div>
            <div class="bg-red-500 text-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">Total Pengeluaran</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-3xl">📉</div>
                </div>
            </div>
            <div class="bg-{{ $keuntunganBersih >= 0 ? 'blue' : 'yellow' }}-500 text-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">Keuntungan Bersih</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($keuntunganBersih, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-3xl">{{ $keuntunganBersih >= 0 ? '💰' : '⚠️' }}</div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
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

        <!-- Transaction Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full border-collapse border border-gray-400 text-sm text-left">
                <thead>
                    <tr class="bg-green-300 text-gray-700">
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">No</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Tanggal</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Kode</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Deskripsi</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Jenis</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Kategori</th>
                        <th scope="col" class="font-bold border border-gray-400 px-4 py-2 text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-400 text-center">
                                {{ $transaksi->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-2 border border-gray-400">
                                @if(is_string($item['tanggal']))
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}
                                @else
                                    {{ $item['tanggal']->format('d/m/Y') }}
                                @endif
                            </td>
                            <td class="px-4 py-2 border border-gray-400">
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $item['kode'] }}</code>
                            </td>
                            <td class="px-4 py-2 border border-gray-400 max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">
                                {{ $item['deskripsi'] }}
                            </td>
                            <td class="px-4 py-2 border border-gray-400 text-center">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $item['jenis'] == 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item['jenis'] == 'pemasukan' ? '⬆️' : '⬇️' }} {{ ucfirst($item['jenis']) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border border-gray-400 text-center">
                                <span class="inline-block px-2 py-1 rounded bg-gray-100 text-gray-800 text-xs">
                                    {{ $item['kategori'] ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border border-gray-400 text-right font-semibold {{ $item['jenis'] == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item['jenis'] == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($item['jumlah'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 border border-gray-400 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <div class="text-6xl mb-4">📭</div>
                                    <h3 class="text-lg font-semibold mb-2">Tidak ada data transaksi</h3>
                                    <p class="text-sm">Belum ada transaksi untuk periode yang dipilih</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                @if($transaksi->count() > 0)
                <tfoot class="bg-gray-100">
                    <tr>
                        <th colspan="6" class="px-4 py-2 border border-gray-400 text-right font-bold">Total Halaman:</th>
                        <th class="px-4 py-2 border border-gray-400 text-right font-bold">
                            @php
                                $totalHalaman = 0;
                                foreach($transaksi as $item) {
                                    if($item['jenis'] == 'pemasukan') {
                                        $totalHalaman += $item['jumlah'];
                                    } else {
                                        $totalHalaman -= $item['jumlah'];
                                    }
                                }
                            @endphp
                            <span class="{{ $totalHalaman >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($totalHalaman, 0, ',', '.') }}
                            </span>
                        </th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <!-- Pagination -->
        @if($transaksi->hasPages())
        <div class="flex justify-between items-center mt-6 bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-600">
                Menampilkan {{ $transaksi->firstItem() }} sampai {{ $transaksi->lastItem() }} 
                dari {{ $transaksi->total() }} transaksi
            </div>
            <div>
                {{ $transaksi->appends(request()->query())->links() }}
            </div>
        </div>
        @endif

        <!-- Info Footer -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="text-blue-400 text-xl">ℹ️</div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi Laporan Keuangan</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>Pemasukan:</strong> Data diambil dari tabel pesanan berdasarkan total harga detail pesanan</li>
                            <li><strong>Pengeluaran:</strong> Data diambil dari tabel stok masuk dengan estimasi 70% dari harga jual produk</li>
                            <li><strong>Filter:</strong> Gunakan filter di atas untuk melihat data berdasarkan periode dan jenis transaksi</li>
                            <li><strong>Export:</strong> Klik tombol PDF atau Excel untuk mengunduh laporan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto submit form when filter changes
        document.addEventListener('DOMContentLoaded', function() {
            const selects = ['bulan', 'tahun', 'jenis', 'urutan'];
            selects.forEach(function(selectId) {
                document.getElementById(selectId).addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });
        });
    </script>
</x-layout>