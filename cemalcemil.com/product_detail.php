<?php 
include_once ("service/koneksi.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $query = "SELECT * FROM produk WHERE id = $id";
  $hasil = mysqli_query($conn, $query);
  $produk = mysqli_fetch_assoc($hasil);

  if (!$produk) {
      echo "<p>Produk tidak ditemukan.</p>";
      exit;
  }
} else {
  echo "<p>ID produk tidak valid.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Produk - <?= htmlspecialchars($produk['nama_produk']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen font-sans bg-gray-100">

<?php include 'layout/header.php'; ?>

<!-- Detail Produk -->
<div class="container mx-auto my-10 py-10 px-4">
  <div class="flex flex-col md:flex-row g-3 items-center"> 
    <div class="md:w-1/2 flex justify-center">
      <img src="gambar.php?id=<?= $produk['id'] ?>" class="w-full h-64 object-contain" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
    </div>
    <div class="md:w-1/2 p-4">
      <h2 class="font-bold text-2xl mb-2"><?= htmlspecialchars($produk['nama_produk']) ?></h2>
      <p class="mb-2"><?= $produk['deskripsi'] ?? 'Produk lezat dan menyehatkan untuk menemani harimu.' ?></p>
      <h4 class="text-green-600 font-bold mb-2">Rp <?= number_format($produk['harga_jual'], 0, ',', '.') ?></h4>

      <?php 
        $satuan = (strpos($produk['nama_produk'], 'Susu') !== false) ? 'ml' : 'gram';
      ?>

      <p class="mb-1">Berat: <?= $produk['kuantitas_produk'] ?> <?= $satuan ?></p>
      <p class="mb-3">Stok: <?= $produk['stok_akhir'] ?> tersedia</p>

      <form action="cart.php" method="POST">
        <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
        <input type="hidden" name="nama" value="<?= $produk['nama_produk'] ?>">
        <input type="hidden" name="harga" value="<?= $produk['harga_jual'] ?>">
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah:</label>
          <input type="number" name="jumlah" id="jumlah" class="border rounded p-2" value="1" min="1" max="<?= $produk['stok_akhir'] ?>">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Masukkan ke Keranjang
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Tombol Kembali -->
<div class="container mx-auto mb-10">
  <a href="product.php" class="bg-gray-300 text-gray-800 py-2 px-4 ml-10 rounded hover:bg-gray-400">
    Kembali ke Katalog
  </a>
</div>

<?php include 'layout/footer.php'; ?>

</body>
</html>