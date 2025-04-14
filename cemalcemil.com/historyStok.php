<?php
include 'service/koneksi.php';

// Ambil filter dari URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';
$date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'newest';
$product_code = isset($_GET['product_code']) ? $_GET['product_code'] : '';

// Siapkan query gabungan
$sql = "";

if ($filter == 'masuk') {
    $sql = "SELECT m.tanggal_masuk AS tanggal, m.kode_produk, p.nama_produk, m.jumlah_masuk AS jumlah, 'masuk' AS jenis 
            FROM stok_masuk m
            JOIN produk p ON m.kode_produk = p.kode_produk";
} elseif ($filter == 'keluar') {
    $sql = "SELECT k.tanggal_keluar AS tanggal, k.kode_produk, p.nama_produk, k.jumlah_keluar AS jumlah, 'keluar' AS jenis 
            FROM stok_keluar k
            JOIN produk p ON k.kode_produk = p.kode_produk";
} else {
    $sql = "
        SELECT m.tanggal_masuk AS tanggal, m.kode_produk, p.nama_produk, m.jumlah_masuk AS jumlah, 'masuk' AS jenis 
        FROM stok_masuk m
        JOIN produk p ON m.kode_produk = p.kode_produk
        UNION
        SELECT k.tanggal_keluar AS tanggal, k.kode_produk, p.nama_produk, k.jumlah_keluar AS jumlah, 'keluar' AS jenis 
        FROM stok_keluar k
        JOIN produk p ON k.kode_produk = p.kode_produk
    ";
}

// Apply date filter
if ($date_filter == 'oldest') {
    $sql .= " ORDER BY tanggal ASC";
} else {
    $sql .= " ORDER BY tanggal DESC";
}

$query = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cemal-Cemil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 ">
<div class="bg-green-700 sticky top-0 shadow-md z-[1030]">
    <nav class="container mx-auto flex items-center justify-center p-4">
        <a href="dashboardAdmin.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kembali</a>
        <a href="tambahStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Tambah Stok</a>
        <a href="historyStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Histori</a>
        <a href="stok.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Laporan Manajemen</a>
    </nav>
</div>

<div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h1 class="text-2xl flex items-center justify-center font-bold mb-6">Histori Stok</h1>

    <!-- Filter -->
    <form method="GET" class="mb-4 flex items-center space-x-4">
        <label for="filter" class="text-lg">Filter:</label>
        <select name="filter" id="filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="semua" <?= $filter == 'semua' ? 'selected' : '' ?>>Semua</option>
            <option value="masuk" <?= $filter == 'masuk' ? 'selected' : '' ?>>Stok Masuk</option>
            <option value="keluar" <?= $filter == 'keluar' ? 'selected' : '' ?>>Stok Keluar</option>
        </select>

        <label for="date_filter" class="text-lg">Tanggal :</label>
        <select name="date_filter" id="date_filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="newest" <?= $date_filter == 'newest' ? 'selected' : '' ?>>Terbaru</option>
            <option value="oldest" <?= $date_filter == 'oldest' ? 'selected' : '' ?>>Terlama</option>
        </select>
    </form>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Kode produk</th>
                    <th class="border px-4 py-2">Nama produk</th>
                    <th class="border px-4 py-2">Jenis</th>
                    <th class="border px-4 py-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $query->fetch_assoc()): ?>
                    <tr class="border-t <?= $row['jenis'] == 'masuk' ? 'bg-green-100' : 'bg-red-100' ?>">
                        <td class="border px-4 py-2"><?= $row['tanggal'] ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['kode_produk']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td class="border px-4 py-2">
                            <span class="text-white px-2 py-1 items-center justify-center flex rounded text-xs font-semibold 
                            <?= $row['jenis'] == 'masuk' ? 'bg-green-500' : 'bg-red-500' ?>">
                                <?= strtoupper($row['jenis']) ?>
                            </span>
                        </td>
                        <td class="border px-4 py-2"><?= $row['jumlah'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>