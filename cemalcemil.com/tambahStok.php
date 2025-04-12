<?php
include_once("service/koneksi.php");

$produk = $conn->query("SELECT * FROM produk");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_produk = $_POST['kode_produk'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO stok_masuk (tanggal_masuk, kode_produk, jumlah_masuk) 
            VALUES ('$tanggal', '$kode_produk', $jumlah)";

    if ($conn->query($query)) {
        header("Location: historyStok.php"); 
        exit;
    } else {
        echo "Gagal menambahkan stok: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Stok Masuk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="bg-green-700 sticky top-0 shadow-md z-[1030]">
        <nav class="container mx-auto flex items-center justify-center p-4">
            <a href="dashboardAdmin.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kembali</a>
            <a href="tambahStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Tambah Stok</a>
            <a href="historyStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Histori</a>
            <a href="stok.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Laporan Manajemen</a>
        </nav>
    </div>

  <div class="max-w-xl mt-8 mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Tambah Stok Masuk</h1>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block font-semibold">Tanggal Masuk</label>
            <input type="date" name="tanggal" required class="w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block font-semibold">Pilih Produk</label>
            <select name="kode_produk" required class="w-full border rounded px-3 py-2">
            <?php while ($row = $produk->fetch_assoc()): ?>
                <option value="<?= $row['kode_produk'] ?>"><?= $row['kode_produk'] ?> - <?= $row['nama_produk'] ?></option>
            <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Jumlah Masuk</label>
            <input type="number" name="jumlah" required class="w-full border rounded px-3 py-2" min="1" />
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan
            </button>
        </div>
    </form>
  </div>
</body>
</html>
