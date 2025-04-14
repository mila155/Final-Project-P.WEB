<?php
include_once("service/koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT foto FROM produk WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header("Content-Type: image/png"); // Atau image/png sesuai jenis gambar
        echo $row['foto'];
        exit;
    }
}
echo "Gambar tidak ditemukan.";
?>
