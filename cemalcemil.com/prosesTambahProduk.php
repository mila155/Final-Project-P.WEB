<?php 
    include_once("service/koneksi.php");
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kuantitas = $_POST['kuantitas'];
    $satuan = $_POST['satuan'];
    $harga_jual = $_POST['hargaJ'];
    $harga_produksi = $_POST['hargaP'];
    $deskripsi = $_POST['deskripsi'];
    $query="INSERT INTO produk (kode_produk,nama_produk,kuantitas_produk,satuan,harga_jual,harga_produksi,deskripsi) VALUE 
    ('$kode','$nama','$kuantitas','$satuan','$harga_jual','$harga_produksi','$deskripsi')";
    $hasil=mysqli_query($conn,$query);

    if ($hasil) {
        header('location:produkAdmin.php');
    } else {
        echo "input data gagal";
    }
?>