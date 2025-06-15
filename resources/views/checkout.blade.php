<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-yellow-300 text-black p-6 rounded-lg text-center mb-8">
            <h2 class="text-2xl font-bold">Checkout Pesanan</h2>
            <p>Isi data dengan benar sebelum menyelesaikan pesanan</p>
        </div>

        <form method="POST" action="{{ route('checkout.store') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <h4 class="text-lg font-semibold text-yellow-500 mb-4">📝 Data Pelanggan</h4>

            {{-- <div class="mb-4">
                <label class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3" required class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
            </div>
            <div class="mb-6">
                <label class="block font-medium mb-1">Kontak (No HP / WA)</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" required class="w-full border rounded px-3 py-2">
            </div> --}}

            @php
                $user = Auth::user();
            @endphp

            <div class="mb-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="isi_dari_user" class="mr-2">
                    Gunakan data akun saya
                </label>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="input_nama" name="nama" value="{{ old('nama') }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3" required class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Kontak (No HP / WA)</label>
                <input type="text" id="input_kontak" name="kontak" value="{{ old('kontak') }}" required class="w-full border rounded px-3 py-2">
            </div>

            <input type="hidden" id="user_name" value="{{ $user->user_name }}">
            <input type="hidden" id="user_kontak" value="{{ $user->user_email }}"> 


            <h4 class="text-lg font-semibold text-green-600 mb-4">🛒 Ringkasan Belanja</h4>
            <ul class="mb-4">
                @foreach ($keranjang as $item)
                    <li class="flex justify-between items-center border-b py-2">
                        <span>{{ $item->nama }} (x{{ $item->jumlah }})</span>
                        <span>Rp {{ number_format
                        ($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="bg-green-100 border border-green-300 text-green-800 font-bold rounded-md px-4 py-3 flex justify-between mb-6">
                <span>Total Bayar:</span>
                <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('cart.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">&larr; Kembali ke Keranjang</a>
                <button type="submit" class="bg-yellow-400 text-black font-semibold px-4 py-2 rounded">✔ Selesaikan Pesanan</button>
            </div>
        </form>
    </div>

    <script>
        const checkbox = document.getElementById('isi_dari_user');
        const inputNama = document.getElementById('input_nama');
        const inputKontak = document.getElementById('input_kontak');

        const userNama = document.getElementById('user_name').value;
        const userKontak = document.getElementById('user_kontak').value;

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                inputNama.value = userNama;
                inputNama.readOnly = true;

                inputKontak.value = userKontak;
                inputKontak.readOnly = true;
            } else {
                inputNama.value = '';
                inputNama.readOnly = false;

                inputKontak.value = '';
                inputKontak.readOnly = false;
            }
        });
    </script>

</x-layout>