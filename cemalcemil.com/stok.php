<?php
    include 'service/koneksi.php';

    $query = "
        SELECT 
            p.kode_produk,
            p.nama_produk,
            p.harga_jual,
            COALESCE(SUM(sm.jumlah_masuk), 0) AS total_masuk,
            COALESCE(SUM(sk.jumlah_keluar), 0) AS total_keluar,
            MAX(sm.tanggal_masuk) AS tanggal_terakhir_masuk
        FROM produk p
        INNER JOIN stok_masuk sm ON p.kode_produk = sm.kode_produk
        LEFT JOIN stok_keluar sk ON p.kode_produk = sk.kode_produk
        
    ";

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

<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">       
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Stok Produk</h2>
        <a href="adminTailwind.php" class="inline-block mb-3 bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
        <a href="tambahStok.php" class="inline-block mb-3 bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Tambah Stok</a>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border">
                <thead>
                    <tr class="bg-green-300">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Kode Produk</th>
                    <th class="border px-4 py-2">Nama Produk</th>
                    <th class="border px-4 py-2">Stok Awal</th>
                    <th class="border px-4 py-2">Harga</th>
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
                        $stok_awal = 0; // Jika belum ada perhitungan historis
                        $stok_akhir = $stok_awal + $data['total_masuk'] - $data['total_keluar'];
                    ?>
                    <tr>
                    <td class="border px-4 py-2"><?php echo $no++; ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($data['kode_produk']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($data['nama_produk']); ?></td>
                    <td class="border px-4 py-2"><?php echo $stok_awal; ?></td>
                    <td class="border px-4 py-2"><?php echo number_format($data['harga_jual'], 0, ',', '.'); ?></td>
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