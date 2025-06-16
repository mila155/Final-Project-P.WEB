<x-layout>
       <x-navbar></x-navbar>
       <x-slot:title>Payment Page</x-slot:title>

       <div class="max-w-5xl mx-auto px-4 py-10">
           <div class="bg-yellow-300 text-black p-6 rounded-lg text-center mb-8">
               <h2 class="text-2xl font-bold">Pembayaran Pesanan</h2>
               <p>Lengkapi metode pembayaran dan unggah bukti pembayaran</p>
           </div>

           <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
               @csrf
               <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">

               <h4 class="text-lg font-semibold text-yellow-500 mb-4">💳 Metode Pembayaran</h4>

               <div class="mb-4">
                   <label class="block font-medium mb-1">Pilih Metode Pembayaran</label>
                   <select name="metode_pembayaran" required class="w-full border rounded px-3 py-2">
                       <option value="" disabled selected>Pilih metode</option>
                       <option value="bank_transfer">Transfer Bank</option>
                       <option value="qris">QRIS</option>
                   </select>
                   @error('metode_pembayaran')
                       <p class="text-red-500 text-sm">{{ $message }}</p>
                   @enderror
               </div>

               <div class="mb-4">
                   <label class="block font-medium mb-1">Bukti Pembayaran (Upload Gambar)</label>
                   <input type="file" name="bukti_pembayaran" accept="image/*" required class="w-full border rounded px-3 py-2">
                   @error('bukti_pembayaran')
                       <p class="text-red-500 text-sm">{{ $message }}</p>
                   @enderror
               </div>

               <h4 class="text-lg font-semibold text-green-600 mb-4">🛒 Ringkasan Pesanan</h4>
               <ul class="mb-4">
                   @foreach ($keranjang as $item)
                       <li class="flex justify-between items-center border-b py-2">
                           <span>{{ $item->produk->nama_produk ?? 'Produk' }} (x{{ $item->jumlah }})</span>
                           <span>Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                       </li>
                   @endforeach
               </ul>

               <div class="bg-green-100 border border-green-300 text-green-800 font-bold rounded-md px-4 py-3 flex justify-between mb-6">
                   <span>Total Bayar:</span>
                   <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
               </div>

               <div class="flex justify-between">
                   <button type="submit" class="bg-yellow-400 text-black font-semibold px-4 py-2 rounded">✔ Konfirmasi Pembayaran</button>
               </div>
           </form>
       </div>
   </x-layout>