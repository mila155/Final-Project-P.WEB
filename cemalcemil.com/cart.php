<?php
require 'service/koneksi.php';

// Initialize $cek to null
$cek = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_produk = $_POST['produk_id'] ?? null;
  $nama = $_POST['nama'] ?? '';
  $harga = $_POST['harga'] ?? 0;
  $jumlah = $_POST['jumlah'] ?? 1;

  if (!$id_produk) {
    die('ID produk tidak dikirim!');
  }

  // Cek apakah produk sudah ada di keranjang
  $stmt = $conn->prepare("SELECT * FROM keranjang WHERE produk_id = ?");
  $stmt->bind_param("s", $id_produk);
  $stmt->execute();
  $cek = $stmt->get_result();

  if ($cek->num_rows > 0) {
    // Jika sudah ada, update jumlah
    $stmt = $conn->prepare("UPDATE keranjang SET jumlah = jumlah + ? WHERE produk_id = ?");
    $stmt->bind_param("is", $jumlah, $id_produk);
    $stmt->execute();
  } else {
    // Ambil gambar dari database
    $stmt_gambar = $conn->prepare("SELECT foto FROM produk WHERE id = ?");
    $stmt_gambar->bind_param("s", $id_produk);
    $stmt_gambar->execute();
    $result_gambar = $stmt_gambar->get_result();
    $row_gambar = $result_gambar->fetch_assoc();
    $gambar = $row_gambar['foto'] ?? null;

    // Tambahkan produk ke keranjang
    $stmt = $conn->prepare("INSERT INTO keranjang (produk_id, nama, harga, jumlah, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdib", $id_produk, $nama, $harga, $jumlah, $gambar);
    $stmt->execute();
  }

  // Ambil semua item keranjang
  $stmt = $conn->prepare("SELECT * FROM keranjang");
  $stmt->execute();
  $result = $stmt->get_result();

  // Redirect ke cart
  header("Location: cart.php");
  exit;
} else {
  // If not a POST request, fetch the cart items
  $stmt = $conn->prepare("SELECT * FROM keranjang");
  $stmt->execute();
  $cek = $stmt->get_result(); // Now $cek will be defined here as well
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja - Cemal Cemil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">
  <?php include 'layout/header.php'; ?>

  <div class="container mx-auto my-10 py-10 px-4">
    <h2 class="mb-4 text-2xl font-bold">Keranjang Belanja</h2>

    <?php if ($cek && $cek->num_rows > 0): ?>
    <table class="min-w-full border border-gray-300">
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
        <?php $grandTotal = 0; ?>
        <?php while($item = $cek->fetch_assoc()): ?>
          <?php $total = $item['harga'] * $item['jumlah']; $grandTotal += $total; ?>
          <tr>
            <td class="border px-4 py-2"><img src="data:image/png;base64,<?= base64_encode($item['gambar']) ?>" width="60"></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($item['nama']) ?></td>
            <td class="border px-4 py-2">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
            <td class="border px-4 py-2"><?= $item['jumlah'] ?></td>
            <td class="border px-4 py-2">Rp <?= number_format($total, 0, ',', '.') ?></td>
            <td class="border px-4 py-2">
              <div class="flex gap-1">
                <form action="edit_cart.php" method="POST" class="flex gap-1">
                  <input type="hidden" name="id" value="<?= $item['id'] ?>">
                  <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" class="border rounded p-1 w-16">
                  <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</button>
                </form>
                <a href="hapus_cart.php?id=<?= $item['id'] ?>" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('Apakah kamu yakin ingin menghapus produk ini dari keranjang?');">Delete</a>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4" class="text-right border px-4 py-2">Total Belanja:</th>
          <th class="border px-4 py-2">Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
          <th class="border px-4 py-2"></th>
        </tr>
      </tfoot>
    </table>

    <div class="text-right mt-4">
      <a href="product.php" class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">Lanjut Belanja</a>
      <a href="checkout.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Checkout</a>
    </div>
    <?php else: ?>
      <div class="alert alert-info">Keranjang kamu masih kosong, yuk belanja dulu!</div>
      <a href="product.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Kembali ke Produk</a>
    <?php endif; ?>
  </div>

  <?php include 'layout/footer.php'; ?>
</body>
</html>