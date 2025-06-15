<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title> 

    <div class="max-w-4xl mx-auto my-10 py-10 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Data Produk</h2>
        <form id="inventoryForm" method="POST" action="{{ route('produk.store') }}" class="mb-4">
            @csrf
            <div class="gap-4">
                <div class="my-1 mx-3">
                    <label for="kode_produk" class="block text-gray-700 mb-1">Kode Produk :</label>
                    <input type="text" name="kode_produk" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Kode" value="{{ old('kode_produk') }}" required>
                    @error('kode_produk')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="nama_produk" class="block text-gray-700 mb-1">Nama Produk :</label>
                    <input type="text" name="nama_produk" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Nama" value="{{ old('nama_produk') }}" required>
                    @error('nama_produk')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="stok" class="block text-gray-700 mb-1">Stok Produk :</label>
                    <input type="number" name="stok" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Stok" value="{{ old('stok') }}" required>
                    @error('stok')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="kuantitas_produk" class="block text-gray-700 mb-1">Kuantitas produk :</label>
                    <input type="number" name="kuantitas_produk" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Kuantitas" value="{{ old('kuantitas_produk') }}" required>
                    @error('kuantitas_produk')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="satuan" class="block text-gray-700 mb-1">Satuan kuantitas :</label>
                    <select name="satuan" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" required>
                        <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>gram</option>
                        <option value="ml" {{ old('satuan') == 'ml' ? 'selected' : '' }}>ml</option>
                    </select>
                    @error('satuan')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="harga_jual" class="block text-gray-700 mb-1">Harga Jual :</label>
                    <input type="number" name="harga_jual" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" value="{{ old('harga_jual') }}" required>
                    @error('harga_jual')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="harga_produksi" class="block text-gray-700 mb-1">Harga Produksi :</label>
                    <input type="number" name="harga_produksi" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" value="{{ old('harga_produksi') }}" required>
                    @error('harga_produksi')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-1 mx-3">
                    <label for="deskripsi" class="block text-gray-700 mb-1">Deskripsi :</label>
                    <input type="text" name="deskripsi" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Deskripsi" value="{{ old('deskripsi') }}">
                    @error('deskripsi')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-end w-full m-2">
                    <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg mr-2">Tambah</button>
                    <a href="{{ route('index') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
                </div>
            </div>
        </form>
    </div>  
</x-layout>