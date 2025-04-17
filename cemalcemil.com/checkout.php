<?php

require 'service/koneksi.php';

// Cek apakah user sudah login
session_start();
if (!isset($_SESSION['id_user']) && $_SESSION['user_id'] == '') {
  echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
  exit;
}

$id_user = $_SESSION['user_id'];

// Ambil isi keranjang
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

  $stmt = $conn->prepare("INSERT INTO pesanan (id_user, nama, alamat, kontak) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isss", $id_user, $nama, $alamat, $kontak);
  $stmt->execute();
  $pesananId = $conn->insert_id;

  foreach ($keranjang as $item) {
    $stmtDetail = $conn->prepare("INSERT INTO pesanan_detail (pesanan_id, produk_id, harga, jumlah) VALUES (?, ?, ?, ?)");
    $stmtDetail->bind_param("isii", $pesananId, $item['produk_id'], $item['harga'], $item['jumlah']);
    $stmtDetail->execute();
  }

  $conn->query("DELETE FROM keranjang");

  echo "<script>alert('Pesanan berhasil dilakukan!'); window.location='index.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Cemal Cemil</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 py-10">
    <div class="max-w-5xl mx-auto px-4">
      <!-- Header -->
      <div class="bg-gradient-to-r from-yellow-300 to-yellow-400 text-black p-6 rounded-lg text-center mb-8">
        <h2 class="text-2xl font-bold">Checkout Pesanan</h2>
        <p>Isi data dengan benar sebelum menyelesaikan pesanan</p>
      </div>

      <!-- Form Box -->
      <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <!-- Data Pelanggan -->
        <h4 class="text-lg font-semibold text-yellow-500 mb-4">📝 Data Pelanggan</h4>
        <div class="mb-4">
          <label class="block font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
        </div>
        <div class="mb-4">
          <label class="block font-medium mb-1">Alamat</label>
          <textarea name="alamat" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required></textarea>
        </div>
        <div class="mb-6">
          <label class="block font-medium mb-1">Kontak (No HP / WA)</label>
          <input type="text" name="kontak" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
        </div>

        <!-- Ringkasan Belanja -->
        <h4 class="text-lg font-semibold text-green-600 mb-4">🛒 Ringkasan Belanja</h4>
        <ul class="mb-4">
          <?php foreach ($keranjang as $item): ?>
            <li class="flex justify-between items-center border-b py-2">
              <span><?= $item['nama'] ?> (x<?= $item['jumlah'] ?>)</span>
              <span>Rp <?= number_format($item['total'], 0, ',', '.') ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <!-- Total -->
        <div class="bg-green-100 border border-green-300 text-green-800 font-bold rounded-md px-4 py-3 flex justify-between mb-6">
          <span>Total Bayar:</span>
          <span>Rp <?= number_format($totalBayar, 0, ',', '.') ?></span>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between">
          <a href="cart.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">&larr; Kembali ke Keranjang</a>
          <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded">✔ Selesaikan Pesanan</button>
        </div>
      </form>
    </div>
  </body>
</html>