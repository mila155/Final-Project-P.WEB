<?php
$password = 'superadmin123'; // ganti dengan password yang kamu mau
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash: " . $hash;
?>
