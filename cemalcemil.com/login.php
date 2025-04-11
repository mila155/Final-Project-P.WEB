<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center bg-cover bg-center">
  <div class="bg-white bg-opacity-90 rounded-lg shadow-lg flex max-w-4xl w-full">
    
    <!-- Form Login -->
    <div class="w-full md:w-1/2 p-8">
      <h2 class="text-2xl font-bold text-center text-green-600">Login ke Cemal Cemil</h2>
      <p class="text-center text-gray-500 mb-4"></p>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block text-gray-700">Email</label>
          <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" />
        </div>
        <div>
          <label class="block text-gray-700">Password</label>
          <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" />
        </div>
        <button type="submit" name="login" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">Login</button>
      </form>

      <p class="text-center text-gray-600 mt-4">
        Belum punya akun? <a href="register.php" class="text-green-600 hover:underline">Daftar di sini</a>
      </p>
    </div>

    <!-- Gambar Samping -->
    <div class="hidden md:block w-1/2 bg-cover bg-center rounded-r-lg">
    <img src="./img/logonew.png" alt="Logo" class="object-contain h-full w-full">
    </div>
  </div>
</body>
</html>

<?php
// Proses Login
if (isset($_POST['login'])) {
    $conn = new mysqli("localhost", "root", "", "cemal_cemil");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek user berdasarkan email
    $query = "SELECT * FROM pengguna WHERE user_email = '$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {

           // Mulai session dan simpan data user
          session_start();
          $_SESSION['user_id'] = $user['id']; // pastikan kolomnya benar, bisa juga user_id
          $_SESSION['user_name'] = $user['user_name'];
          $_SESSION['role'] = $user['role'];

          if ($user['role'] == 'admin') {
              echo "<script>alert('Login berhasil sebagai Admin!'); window.location.href = 'dashboardAdmin.php';</script>";
          } else {
              echo "<script>alert('Login berhasil sebagai User!'); window.location.href = 'index.php';</script>";
          }
      }      
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }

    $conn->close();
}
?>
