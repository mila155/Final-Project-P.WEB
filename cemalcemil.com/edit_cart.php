<?php
require 'service/koneksi.php';

$id = $_POST['id'] ?? null;
$jumlah = $_POST['jumlah'] ?? null;

if ($id && $jumlah) {
    $stmt = $conn->prepare("UPDATE keranjang SET jumlah = ? WHERE id = ?");
    $stmt->bind_param("ii", $jumlah, $id);
    $stmt->execute();
    $stmt->close();
}

// Kembali ke cart
header("Location: cart.php");
exit;