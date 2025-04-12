<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <div class="bg-green-700 sticky top-0 shadow-md z-[1030]">
        <nav class="container mx-auto flex items-center justify-between px-4 py-3">
            <!-- Logo & Text -->
            <div class="flex items-center space-x-4">
                <img src="./img/logo.png" alt="logo" class="h-12">
                <a href="#" class="text-white font-bold text-xl no-underline">Banana</a>
            </div>
            <div class="flex items-end">
                <a href="#" class="text-white hover:text-yellow-300">Welcome Guest</a>
            </div>
        </nav>
    </div>

    <!-- Header -->
    <div class="bg-gray-200 text-center py-3">
        <h3 class="text-xl font-semibold">Manage Details</h3>
    </div>

    <!-- Admin Section -->
    <div class="bg-gray-700 flex flex-wrap items-start gap-6 px-6 py-6">
        <div class="text-center">
            <img src="img/1.jpg" alt="admin-photo" class="w-20 rounded-lg">
            <p class="text-white font-bold mt-2">Admin Name</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="produkAdmin.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Produk</a>
            <a href="historyStok.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Stok Produk</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Penjualan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Keuangan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Daftar Pelanggan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kelola Admin</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Keluar</a>
        </div>
    </div>
</body>
</html>
