<?php
$conn = new mysqli("localhost", "root", "", "cemal_cemil");

// Ambil data berdasarkan email
if (isset($_GET['email'])) {
  $email = $conn->real_escape_string($_GET['email']);
  $result = $conn->query("SELECT * FROM pengguna WHERE user_email = '$email' AND role = 'admin'");
  $admin = $result->fetch_assoc();

  if (!$admin) {
    echo "Admin tidak ditemukan.";
    exit;
  }
}

// Proses update data
if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];
  $new_email = $_POST['email'];

  $conn->query("UPDATE pengguna SET 
    user_name = '$nama', 
    user_alamat = '$alamat', 
    user_telp = '$telp', 
    user_email = '$new_email' 
    WHERE user_email = '$email' AND role = 'admin'");

  header("Location: tambah_admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-700 mb-4">Edit Data Admin</h2>

    <form action="" method="POST" class="space-y-4">
      <div>
        <label class="block mb-1">Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($admin['user_name']) ?>" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block mb-1">Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($admin['user_alamat']) ?>" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block mb-1">No. Telepon</label>
        <input type="text" name="telp" value="<?= htmlspecialchars($admin['user_telp']) ?>" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block mb-1">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($admin['user_email']) ?>" class="w-full border rounded px-3 py-2">
      </div>

      <button type="submit" name="update" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
      <a href="tambahAdmin.php" class="ml-4 text-green-600 hover:underline">Batal</a>
    </form>
  </div>
</body>
</html>
