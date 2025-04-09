<?php
require 'koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $conn->query("DELETE FROM keranjang WHERE id = $id");
}

header("Location: cart.php");
exit;