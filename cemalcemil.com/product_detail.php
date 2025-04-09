<?php
require 'produklist.php';
$id = $_GET['id'] ?? '';
$produk = $produkList[$id] ?? null;

$id = $_GET['id'] ?? '';
$produk = $produkList[$id] ?? null;

if (!$produk) {
  echo "<h3 class='text-center mt-5'>Produk tidak ditemukan.</h3>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Produk - <?= htmlspecialchars($produk['nama']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column min-vh-100" style="padding-top: 70px;">

<!-- Navbar -->
<div class="container-fluid p-0">
  <nav class="navbar fixed-top navbar-expand-xl">
    <div class="container-fluid">
      <img src="./img/logonew.png" alt="logo" class="img-fluid" style="max-width: 50px;">
      <a class="navbar-brand text-white fw-bold" href="#">Cemal Cemil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="product.php">Our Product</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<!-- Detail Produk -->
<div class="container mt-4 mb-4">
  <div class="row g-3 align-items-center"> <!-- tambahkan g-3 untuk spasi horizontal -->
    <div class="col-md-5 d-flex justify-content-center">
      <img src="<?= $produk['gambar'] ?>" class="img-fluid rounded shadow-sm" 
           style="max-width: 250px;" alt="<?= htmlspecialchars($produk['nama']) ?>">
    </div>
    <div class="col-md-7">
      <h2 class="fw-bold mb-2"><?= htmlspecialchars($produk['nama']) ?></h2>
      <p class="mb-2"><?= $produk['deskripsi'] ?? 'Produk lezat dan menyehatkan untuk menemani harimu.' ?></p>
      <h4 class="text-success fw-bold mb-2">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h4>

      <?php 
        $satuan = (strpos($produk['nama'], 'Susu') !== false) ? 'ml' : 'gram';
      ?>

      <p class="mb-1">Berat: <?= $produk['berat'] ?> <?= $satuan ?></p>
      <p class="mb-3">Stok: <?= $produk['stok'] ?> tersedia</p>

      <a href="cart.php?id=<?= $id ?>" class="btn btn-primary">
        <i class="fas fa-cart-plus"></i> Masukkan ke Keranjang
      </a>
    </div>
  </div>
</div>

<!-- Tombol Kembali -->
<div class="container mb-4">
  <a href="product.php" class="btn btn-outline-secondary">
    <i class="fas fa-arrow-left"></i> Kembali ke Katalog
  </a>
</div>

<!-- Footer -->
<footer class="custom-footer text-white py-5 mt-auto">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-3">
        <h4 class="text-success fw-bold">Cemal Cemil</h4>
        <p>Cemal Cemil - produsen keripik pisang, granola, dan susu pisang</p>
        <div class="d-flex gap-3">
          <a href="#"><i class="fab fa-instagram text-white fs-4"></i></a>
          <a href="#"><i class="fab fa-facebook text-white fs-4"></i></a>
        </div>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold">Pages</h6>
        <ul class="list-unstyled">
          <li><a href="product.php" class="footer-link">Our Product</a></li>
          <li><a href="index.php" class="footer-link">About us</a></li>
          <li><a href="cart.php" class="footer-link">Cart</a></li>
          <li><a href="#" class="footer-link">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold">Our info</h6>
        <p><span class="text-warning">6288888888</span><br>
          <a href="mailto:bumiraya@CemalCemil.com" class="footer-link">bumiraya@CemalCemil.com</a><br>
          Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar,<br>
          Surabaya, Jawa Timur 60294, Indonesia
        </p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>