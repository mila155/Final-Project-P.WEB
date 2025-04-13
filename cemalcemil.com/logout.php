<?php
session_start();
session_unset();  // Hapus semua data session
session_destroy(); // Hapus session sepenuhnya

header("Location: index.php"); // Redirect ke halaman depan
exit;
?>
