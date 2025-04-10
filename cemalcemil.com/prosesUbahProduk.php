<?php
include_once("service/koneksi.php");

// Pastikan ID dikirim dan tidak kosong
if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("Error: ID tidak ditemukan! Pastikan form mengirim ID.");
}

// Ambil data dari form
$id = $_POST['id'];
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kuantitas = $_POST['kuantitas'];
$satuan = $_POST['satuan'];
$harga_jual = $_POST['hargaJ'];
$harga_produksi = $_POST['hargaP'];
$deskripsi = $_POST['deskripsi'];

// Gunakan prepared statement untuk keamanan
$query = $conn->prepare("UPDATE produk SET kode_produk=?, nama_produk=?, kuantitas_produk=?, satuan=?, harga_jual=?, harga_produksi=?, deskripsi=? WHERE id=?");
$query->bind_param("ssisddsi", $kode, $nama, $kuantitas, $satuan, $harga_jual, $harga_produksi, $deskripsi ,$id);

// Eksekusi query
$hasil = $query->execute();

if ($hasil) {
    header('Location: produkAdmin.php');
} else {
    echo "Update data gagal: " . $query->error;
}

// Tutup koneksi
$query->close();
$conn->close();
?>