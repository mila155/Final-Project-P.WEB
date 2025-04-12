<?php
    include 'service/koneksi.php';

    $query_default = "
        SELECT 
            p.kode_produk,
            p.nama_produk,
            p.stok AS stok_awal_db,
            COALESCE(SUM(sm.jumlah_masuk), 0) AS total_masuk,
            COALESCE(SUM(sk.jumlah_keluar), 0) AS total_keluar,
            MAX(sm.tanggal_masuk) AS tanggal_terakhir_masuk
        FROM produk p
        LEFT JOIN stok_masuk sm ON p.kode_produk = sm.kode_produk
        LEFT JOIN stok_keluar sk ON p.kode_produk = sk.kode_produk
        GROUP BY p.kode_produk
    ";

    $tanggal_awal = $_GET['tanggal_awal'] ?? null;
    $tanggal_akhir = $_GET['tanggal_akhir'] ?? null;

    if ($tanggal_awal && $tanggal_akhir) {
        $query_filter = "
            SELECT 
                p.kode_produk,
                p.nama_produk,
                p.stok AS stok_awal_db,
                COALESCE(SUM(sm.jumlah_masuk), 0) AS total_masuk,
                COALESCE(SUM(sk.jumlah_keluar), 0) AS total_keluar,
                MAX(sm.tanggal_masuk) AS tanggal_terakhir_masuk
            FROM produk p
            LEFT JOIN stok_masuk sm ON p.kode_produk = sm.kode_produk AND sm.tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            LEFT JOIN stok_keluar sk ON p.kode_produk = sk.kode_produk AND sk.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            GROUP BY p.kode_produk
            HAVING total_masuk > 0 OR total_keluar > 0
        ";

        $query = $query_filter;
    } else {
        $query = $query_default;
    }

    $hasil = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="bg-green-700 sticky top-0 shadow-md z-[1030]">
        <nav class="container mx-auto flex items-center justify-center p-4">
            <a href="adminTailwind.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kembali</a>
            <a href="tambahStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Tambah Stok</a>
            <a href="historyStok.php" class="bg-green-600 mr-4 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Histori</a>
            <a href="stok.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Laporan Manajemen</a>
        </nav>
    </div>

    <div class="max-w-4xl mt-8 mx-auto bg-white p-6 rounded-lg shadow-lg">       
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Stok Produk</h2>
        
        <form method="GET" class="mb-6 flex justify-center space-x-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="border rounded px-2 py-1" value="<?php echo $_GET['tanggal_awal'] ?? ''; ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="border rounded px-2 py-1" value="<?php echo $_GET['tanggal_akhir'] ?? ''; ?>">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Filter</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="table-auto mt-4 w-full border-collapse border">
                <thead>
                    <tr class="bg-green-300">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Kode Produk</th>
                    <th class="border px-4 py-2">Nama Produk</th>
                    <th class="border px-4 py-2">Stok Awal</th>
                    <th class="border px-4 py-2">Masuk</th>
                    <th class="border px-4 py-2">Keluar</th>
                    <th class="border px-4 py-2">Stok Akhir</th>
                    <th class="border px-4 py-2">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($hasil)) {
                        $stok_awal = $data['stok_awal_db'];
                        $stok_akhir = $stok_awal + $data['total_masuk'] - $data['total_keluar'];
                    ?>
                    <tr>
                    <td class="border px-4 py-2"><?php echo $no++; ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($data['kode_produk']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($data['nama_produk']); ?></td>
                    <td class="border px-4 py-2"><?php echo $stok_awal; ?></td>
                    <td class="border px-4 py-2"><?php echo $data['total_masuk']; ?></td>
                    <td class="border px-4 py-2"><?php echo $data['total_keluar']; ?></td>
                    <td class="border px-4 py-2"><?php echo $stok_akhir; ?></td>
                    <td class="border px-4 py-2"><?php echo $data['tanggal_terakhir_masuk']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 

        <script>     
        function hapusRow(button) {
            let row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
        </script>
    </div>
</body>
</html>