{{-- <?php
    include_once("service/koneksi.php");
    $query = "SELECT * FROM produk";
    $result = mysqli_query($conn, $query);

    $produkList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $produkList[$row['id']] = $row;
    }
?> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alata&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Geist:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Sofia+Sans+Semi+Condensed:ital,wght@0,1..1000;1,1..1000&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
    </style>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Product Page</title>
</head>
<body>
    <x-navbar></x-navbar>
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
                    <h5 class="font-bold">{{ $produk->nama_produk }}</h5>
                    <p class="text-green-600 font-bold">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
                    <p>Berat: {{ $produk->kuantitas_produk }} {{ $satuan }}</p>
                    <p>Stok: {{ $produk->stok_akhir }} pcs</p>
                    <a href="{{ url('produk/' . $produk->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Lihat Detail
                    </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    {{-- <div class="container mx-auto my-10 py-10 px-4">
        <h3 class="text-center text-2xl font-bold">Produk Kami</h3>
        <p class="text-center mb-6">Hadirkan camilan sehat dan lezat dalam keseharianmu!</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($produkList as $produk): ?>
            <?php 
                $satuan = (strpos($produk['nama_produk'], 'Susu') !== false) ? 'ml' : 'gram'; 
            ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="gambar.php?id=<?= $produk['id'] ?>" class="w-full h-48 object-contain" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                <div class="p-4">
                <h5 class="font-bold"><?= htmlspecialchars($produk['nama_produk']) ?></h5>
                <p class="text-green-600 font-bold">Rp <?= number_format($produk['harga_jual'], 0, ',', '.') ?></p>
                <p>Berat: <?= $produk['kuantitas_produk'] ?> <?= $satuan ?></p>
                <p>Stok: <?= $produk['stok_akhir'] ?> pcs</p>
                <a href="product_detail.php?id=<?= $produk['id'] ?>" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Lihat Detail
                </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div> --}}
    <x-footer></x-footer>
</body>
</html>