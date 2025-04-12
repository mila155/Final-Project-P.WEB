<?php
require 'service/koneksi.php';
require 'produklist.php'; // file yang berisi $produkList[]

$id = $_GET['id'] ?? null;

if ($id && isset($produkList[$id])) {
  $produk = $produkList[$id];

  // Cek apakah produk sudah ada di keranjang
  $cek = $conn->query("SELECT * FROM keranjang WHERE produk_id = '$id'");
  if ($cek->num_rows > 0) {
    // Jika ada, tambah jumlah
    $conn->query("UPDATE keranjang SET jumlah = jumlah + 1 WHERE produk_id = '$id'");
  } else {
    // Jika belum, tambahkan baru
    $stmt = $conn->prepare("INSERT INTO keranjang (produk_id, nama, harga, gambar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $id, $produk['nama'], $produk['harga'], $produk['gambar']);
    $stmt->execute();
    $stmt->close();
  }

  // Redirect setelah ditambahkan
  header("Location: cart.php");
  exit;
}

// Ambil semua data keranjang
$result = $conn->query("SELECT * FROM keranjang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Product - Cemal Cemil</title>
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

<div class="container py-5">
  <h2 class="mb-4 fw-bold">Keranjang Belanja</h2>

  <?php if ($result->num_rows > 0): ?>
  <table class="table table-bordered align-middle">
    <thead class="table-success">
      <tr>
        <th>Gambar</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $grandTotal = 0; ?>
      <?php while($item = $result->fetch_assoc()): ?>
        <?php $total = $item['harga'] * $item['jumlah']; $grandTotal += $total; ?>
        <tr>
          <td><img src="<?= $item['gambar'] ?>" width="60"></td>
          <td><?= htmlspecialchars($item['nama']) ?></td>
          <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
          <td><?= $item['jumlah'] ?></td>
          <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
          <td>
  <div class="d-flex flex-crow gap-1">
    <form action="edit_cart.php" method="POST" class="d-flex gap-1">
      <input type="hidden" name="id" value="<?= $item['id'] ?>">
      <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" class="form-control form-control-sm" style="width: 60px;">
      <button type="submit" class="btn btn-sm btn-warning">Edit</button>
    </form>
    <a href="hapus_cart.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus produk ini dari keranjang?');">Delete</a>
  </div>
</td>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="4" class="text-end">Total Belanja:</th>
        <th>Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
        <th></th>
      </tr>
    </tfoot>
  </table>

  <div class="text-end">
    <a href="product.php" class="btn btn-outline-secondary">Lanjut Belanja</a>
    <a href="checkout.php" class="btn btn-success">Checkout</a>
  </div>
<?php else: ?>
  <div class="alert alert-info">Keranjang kamu masih kosong, yuk belanja dulu!</div>
  <a href="product.php" class="btn btn-primary">Kembali ke Produk</a>
<?php endif; ?>
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

</body>
</html>