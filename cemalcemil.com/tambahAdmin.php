<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    echo "<script>alert('Akses ditolak! Halaman ini hanya untuk Superadmin.'); window.location.href = 'dashboardAdmin.php';</script>";
    exit;
}

include_once("service/koneksi.php");

$success = false;
$error = "";
$edit_mode = false;
$edit_admin = null;

// Hapus admin
if (isset($_GET['delete']) && $_SESSION['role'] === 'superadmin') {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM pengguna WHERE user_id = ? AND role = 'admin'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: tambahAdmin.php");
    exit;
}

// Edit admin (load data)
if (isset($_GET['edit']) && $_SESSION['role'] === 'superadmin') {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM pengguna WHERE user_id = $id AND role = 'admin'");
    if ($result && $result->num_rows > 0) {
        $edit_admin = $result->fetch_assoc();
        $edit_mode = true;
    } else {
        $error = "Admin tidak ditemukan.";
    }
}

// Simpan perubahan (edit)
if (isset($_POST['update_admin'])) {
    $id = intval($_POST['admin_id']);
    $user_name = $_POST['user_name'];
    $user_add = $_POST['user_add'];
    $user_telp = $_POST['user_telp'];
    $user_email = $_POST['user_email'];

    $update = $conn->prepare("UPDATE pengguna SET user_name=?, user_add=?, user_telp=?, user_email=? WHERE user_id=?");
    $update->bind_param("ssssi", $user_name, $user_add, $user_telp, $user_email, $id);

    if ($update->execute()) {
        $success = true;
        header("Location: tambahAdmin.php");
        exit;
    } else {
        $error = "Gagal memperbarui data admin.";
    }
}

// Tambah admin baru
if (isset($_POST['tambah_admin'])) {
    $user_name = $_POST['user_name'];
    $user_add = $_POST['user_add'];
    $user_telp = $_POST['user_telp'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $role = 'admin';

    $stmt = $conn->prepare("INSERT INTO pengguna (user_name, user_email, user_password, user_telp, user_add, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $user_name, $user_email, $user_password, $user_telp, $user_add, $role);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $error = "Gagal menambahkan admin: " . $conn->error;
    }
}

// Ambil semua admin
$admins = [];
$result = $conn->query("SELECT * FROM pengguna WHERE role = 'admin'");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg w-full max-w-xl p-8">
    <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Tambah Admin Baru</h2>

    <?php if ($success): ?>
      <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
        Admin berhasil ditambahkan atau diperbarui!
      </div>
    <?php elseif ($error): ?>
      <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
        Gagal menambahkan atau memperbarui admin: <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="admin_id" value="<?= $edit_admin['user_id'] ?>">
        <?php endif; ?>

        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="user_name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500"
            value="<?= $edit_mode ? htmlspecialchars($edit_admin['user_name']) : '' ?>">
        </div>

        <div>
            <label class="block text-gray-700">Alamat</label>
            <input type="text" name="user_add" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500"
            value="<?= $edit_mode ? htmlspecialchars($edit_admin['user_add']) : '' ?>">
        </div>

        <div>
            <label class="block text-gray-700">No. Telepon</label>
            <input type="text" name="user_telp" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500"
            value="<?= $edit_mode ? htmlspecialchars($edit_admin['user_telp']) : '' ?>">
        </div>

        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="user_email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500"
            value="<?= $edit_mode ? htmlspecialchars($edit_admin['user_email']) : '' ?>">
        </div>

        <?php if (!$edit_mode): ?>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="user_password" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
            </div>
        <?php endif; ?>

        <button type="submit" name="<?= $edit_mode ? 'update_admin' : 'tambah_admin' ?>"
            class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
            <?= $edit_mode ? 'Update Admin' : 'Tambah Admin' ?>
        </button>
    </form>

    <?php if (!empty($admins)): ?>
        <h3 class="text-xl font-semibold text-green-700 mt-8 mb-2">Daftar Admin Saat Ini</h3>
        <div class="overflow-x-auto">
            <table class="w-full border text-sm text-left text-gray-600 mt-2">
                <thead class="bg-green-100 text-green-800">
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">No. Telepon</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border"><?= htmlspecialchars($admin['user_name']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($admin['user_email']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($admin['user_telp']) ?></td>
                            <td class="px-4 py-2 border flex gap-2">
                                <a href="?edit=<?= $admin['user_id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="?delete=<?= $admin['user_id'] ?>" onclick="return confirm('Yakin ingin menghapus admin ini?')" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
        </div>
    <?php endif; ?>

    <p class="text-center mt-4 text-gray-600">
      <a href="dashboardAdmin.php" class="text-green-600 hover:underline">Kembali ke Dashboard</a>
    </p>
  </div>
</body>
</html>
