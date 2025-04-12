<?php
require 'service/koneksi.php';

$items = $conn->query("SELECT * FROM keranjang");
$keranjang = [];
$totalBayar = 0;

while ($row = $items->fetch_assoc()) {
  $row['total'] = $row['harga'] * $row['jumlah'];
  $totalBayar += $row['total'];
  $keranjang[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kontak = $_POST['kontak'];

  $stmt = $conn->prepare("INSERT INTO pesanan (nama, alamat, kontak) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nama, $alamat, $kontak);
  $stmt->execute();
  $pesananId = $conn->insert_id;

  foreach ($keranjang as $item) {
    $stmtDetail = $conn->prepare("INSERT INTO pesanan_detail (pesanan_id, produk_id, nama, harga, jumlah) VALUES (?, ?, ?, ?, ?)");
    $stmtDetail->bind_param("issii", $pesananId, $item['produk_id'], $item['nama'], $item['harga'], $item['jumlah']);
    $stmtDetail->execute();
  }

  $conn->query("DELETE FROM keranjang");

  echo "<script>alert('Pesanan berhasil dilakukan!'); window.location='index.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout - Cemal Cemil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .checkout-header {
      background: linear-gradient(to right, #f9d342, #ffb347);
      color: #000;
      padding: 20px;
      border-radius: 10px;
    }
    .form-box {
      background-color: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
    }
    .total-summary {
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      padding: 15px;
      border-radius: 8px;
    }
  </style>
</head>
<body class="container py-5">

  <div class="checkout-header text-center mb-5">
    <h2 class="fw-bold">Checkout Pesanan</h2>
    <p>Isi data dengan benar sebelum menyelesaikan pesanan</p>
  </div>

  <form method="POST" class="form-box mb-4">
    <h4 class="mb-3 text-warning">📝 Data Pelanggan</h4>
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Kontak (No HP / WA)</label>
      <input type="text" name="kontak" class="form-control" required>
    </div>

    <h4 class="mt-4 text-success">🛒 Ringkasan Belanja</h4>
    <ul class="list-group mb-3">
      <?php foreach ($keranjang as $item): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?= $item['nama'] ?> (x<?= $item['jumlah'] ?>)
          <span>Rp <?= number_format($item['total'], 0, ',', '.') ?></span>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="total-summary fw-bold mb-4 d-flex justify-content-between">
      <div>Total Bayar:</div>
      <div>Rp <?= number_format($totalBayar, 0, ',', '.') ?></div>
    </div>

    <div class="d-flex justify-content-between">
      <a href="cart.php" class="btn btn-secondary">← Kembali ke Keranjang</a>
      <button type="submit" class="btn btn-warning text-dark fw-bold">✔ Selesaikan Pesanan</button>
    </div>
  </form>

</body>
</html>