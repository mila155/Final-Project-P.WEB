<?php 
include_once ("service/koneksi.php");
$query= "SELECT id, kode_produk, nama_produk, kuantitas_produk, satuan, harga_jual, deskripsi FROM produk";
$hasil= mysqli_query ($conn, $query);
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
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Manajemen Data Produk</h2>
        <a href="dashboardAdmin.php" class="inline-block mb-3 bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
        <a href="tambahProduk.php" class="inline-block mb-3 bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Tambah Produk</a>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-400 text-sm text-left">
                <thead>
                    <tr class="bg-green-300 text-gray-700">
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Kode</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Nama</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Kuantitas</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Satuan Kuantitas</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Harga</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Deskripsi</th>
                        <th scope="col" class="font-bold border border-gray-400 rounded-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="inventoryTable">
                    <?php $nomor=1;
                    while ($data=mysqli_fetch_array ($hasil)){
                    ?>
                    <tr>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['kode_produk']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['nama_produk']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['kuantitas_produk']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['satuan']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['harga_jual']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words">
                        <?php echo htmlspecialchars($data['deskripsi']); ?>
                    </td>
                    <td class="px-4 py-2 border max-w-xs overflow-hidden text-ellipsis whitespace-nowrap break-words"> <a href="ubahProduk.php?id=<?php echo $data['id'] ?>">Edit</a> | <a href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a> </td>
                    </tr>
                    <?php $nomor++; } ?>
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