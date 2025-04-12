<?php
    include_once("service/koneksi.php");
    $id=$_GET['id'];
    $query="SELECT * FROM produk WHERE id=" . $id;
    $hasil=mysqli_query($conn,$query);
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
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Ubah Data Produk</h2>
        <form id="inventoryForm" method="post" action="prosesUbahProduk.php" class="mb-4">
            <?php while ($data=mysqli_fetch_array($hasil)) { ?>
                <div class="gap-4">
                <div class="hidden">
                        <label for="id" class="block text-gray-700 mb-1"></label>
                        <input type="number" name="id" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" value="<?php echo $data['id'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="kode" class="block text-gray-700 mb-1">Kode Produk :</label>
                        <input type="text" name="kode" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Kode" value="<?php echo $data['kode_produk'] ?>" readonly>
                    </div>
                    <div class="my-1 mx-3">
                        <label for="nama" class="block text-gray-700 mb-1">Nama Produk :</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Nama" value="<?php echo $data['nama_produk'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="stok" class="block text-gray-700 mb-1">Stok Produk :</label>
                        <input type="number" name="stok" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Stok" value="<?php echo $data['stok'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="kuantitas" class="block text-gray-700 mb-1">Kuantitas produk :</label>
                        <input type="number" name="kuantitas" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Kuantitas" value="<?php echo $data['kuantitas_produk'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="satuan" class="block text-gray-700 mb-1">Satuan kuantitas :</label>
                        <select name="satuan" class="w-full px-3 py-2 mb-2 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Satuan Kuantitas" value="<?php echo $data['satuan'] ?>">
                            <option value="gram">gram</option>
                            <option value="ml">ml</option>
                        </select>
                    </div>
                    <div class="my-1 mx-3">
                        <label for="hargaJ" class="block text-gray-700 mb-1">Harga Jual :</label>
                        <input type="number" name="hargaJ" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" value="<?php echo $data['harga_jual'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="hargaP" class="block text-gray-700 mb-1">Harga Produksi :</label>
                        <input type="number" name="hargaP" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" value="<?php echo $data['harga_produksi'] ?>">
                    </div>
                    <div class="my-1 mx-3">
                        <label for="deskripsi" class="block text-gray-700 mb-1">Deskripsi :</label>
                        <input type="text" name="deskripsi" class="w-full px-3 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-green-700 outline-none" placeholder="Deskripsi" value="<?php echo $data['deskripsi'] ?>">
                    </div>
                    <div class="flex items-end w-full m-2">
                        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg mr-2" onclick="return confirm('Apakah Anda yakin ingin mengubah data ini?')">Ubah</button>
                        <a href="produkAdmin.php" class="inline-block bg-green-700 text-white px-4 py-2 rounded-lg transition duration-700 ease-in-out">Kembali</a>
                    </div>
                </div>
            <?php } ?>
        </form>

        <script>
            function validateForm() {
            let nama = document.getElementById("nama").value;
            let kategori = document.getElementById("kategori").value;
            let jumlah = document.getElementById("jumlah").value;
            let satuan = document.getElementById("satuan").value;
            let harga = document.getElementById("harga").value;
            
            if (nama.trim() === "" || jumlah.trim() === "" || harga.trim() === "") {
                alert("Harap isi semua kolom!");
                return false;
            }
            
            if (jumlah <= 0 || harga <= 0) {
                alert("Jumlah dan harga harus lebih dari 0!");
                return false;
            }}
        </script>
    </div>
</body>
</html>