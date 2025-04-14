<?php
include_once("service/koneksi.php");
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);

$produkList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produkList[$row['id']] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Product - Cemal Cemil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen font-sans bg-gray-100">
  <?php include 'layout/header.php'; ?>

<!-- Daftar Produk -->
<div class="container mx-auto my-10 py-10 px-4">
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
</div>

<?php include 'layout/footer.php'; ?>

</body>
</html>