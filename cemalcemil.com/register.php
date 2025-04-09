<?php
$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Koneksi
  $conn = new mysqli("localhost", "root", "", "smartfactoryhub");
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  }

  // Ambil data dari form
  $user_name = $_POST['user_name'];
  $user_add = $_POST['user_add'];
  $user_telp = $_POST['user_telp'];
  $user_email = $_POST['user_email'];
  $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

  // Simpan ke DB
  $sql = "INSERT INTO pengguna (user_name, user_email, user_password, user_telp, user_add) 
          VALUES ('$user_name', '$user_email', '$user_password', '$user_telp', '$user_add')";

  if ($conn->query($sql) === TRUE) {
    $success = true;
  } else {
    $error = $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg flex w-full max-w-4xl overflow-hidden">
    <div class="w-full md:w-1/2 p-8">
      <h2 class="text-2xl font-bold text-green-700 mb-2 text-center">Register Akun Cemal Cemil</h2>
      <p class="text-sm text-gray-500 mb-6 text-center">Daftar untuk melihat toko ini</p>

      <?php if ($success): ?>
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
          Pendaftaran berhasil! 
        </div>
      <?php elseif ($error): ?>
        <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
          Gagal mendaftar: <?= $error ?>
        </div>
      <?php endif; ?>

      <form action="" method="POST" class="space-y-4">
      <label class="block text-gray-700 text-sm font-bold" for="nama">Username</label>
        <input type="text" name="user_name" placeholder="Nama Akun" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
        <label class="block text-gray-700 text-sm font-bold" for="nama">Alamat</label>
        <input type="text" name="user_add" placeholder="Alamat" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
        <label class="block text-gray-700 text-sm font-bold" for="nama">No. Telepon</label>
        <input type="text" name="user_telp" placeholder="Nomor Telepon" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
        <label class="block text-gray-700 text-sm font-bold" for="nama">Email</label>
        <input type="email" name="user_email" placeholder="Email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
        <label class="block text-gray-700 text-sm font-bold" for="nama">Password</label>
        <input type="password" name="user_password" placeholder="Password" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold">Daftar</button>
      </form>
      <p class="text-center text-gray-600 mt-4">Sudah punya akun? <a href="login.php" class="text-green-600 hover:underline">Login</a></p>
    </div>
    <div class="hidden md:block w-1/2 bg-cover bg-center rounded-r-lg" style="background-image: url('https://unsplash.com/photos/burger-and-fries-on-white-ceramic-plate-vR-IS9aCyHw ');"></div>
  </div>
</body>
</html>
