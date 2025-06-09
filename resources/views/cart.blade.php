<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="container mx-auto my-10 py-10 px-4">
    <h2 class="mb-4 text-2xl font-bold text-green-700">Keranjang Belanja</h2>

    @if ($items->count())
    <table class="min-w-full border border-gray-300 text-sm">
      <thead class="bg-green-600 text-white">
        <tr>
          <th class="border px-4 py-2">Gambar</th>
          <th class="border px-4 py-2">Nama Produk</th>
          <th class="border px-4 py-2">Harga</th>
          <th class="border px-4 py-2">Jumlah</th>
          <th class="border px-4 py-2">Total</th>
          <th class="border px-4 py-2">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @php $grandTotal = 0; @endphp
        @foreach ($items as $item)
          @php
            $total = $item->harga * $item->jumlah;
            $grandTotal += $total;
          @endphp
          <tr>
            <td class="border px-4 py-2">
              @if($item->gambar)
                <img src="data:image/png;base64,{{ base64_encode($item->gambar) }}" width="60" class="object-contain" />
              @else
                <span class="text-gray-400">Tidak ada gambar</span>
              @endif
            </td>
            <td class="border px-4 py-2">
              {{ $item->nama }}
            </td>
            <td class="border px-4 py-2">
              Rp {{ number_format($item->harga, 0, ',', '.') }}
            </td>
            <td class="border px-4 py-2">
              <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                @csrf
                @method('PUT')
                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" class="border rounded p-1 w-16" />
                <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                  Edit
                </button>
              </form>
            </td>
            <td class="border px-4 py-2">
              Rp {{ number_format($total, 0, ',', '.') }}
            </td>
            <td class="border px-4 py-2">
              <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>

      <tfoot>
        <tr>
          <th colspan="4" class="text-right border px-4 py-2 font-semibold">
            Total Belanja: 
          </th>
          <th class="border px-4 py-2 font-semibold">
            Rp {{ number_format($grandTotal, 0, ',', '.') }}
          </th>
          <th class="border px-4 py-2"></th>
        </tr>
      </tfoot>
    </table>

    <div class="text-right mt-6 flex flex-wrap justify-end gap-2">
      <a href="{{ route('product') }}" class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">
        Lanjut Belanja
      </a>
      <a href="{{ route('checkout.index') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
        Checkout
      </a>
    </div>

    @else
      <div class="text-center text-gray-500">
        <p class="mb-4">Keranjang kamu masih kosong, yuk belanja dulu!</p>
        <a href="{{ route('product') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Kembali ke Produk
        </a>
      </div>
    @endif
  </div>
</x-layout>