<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "cemal_cemil");

    // Orders Summary
    $orders_total = $conn->query("SELECT COUNT(*) as total FROM pesanan")->fetch_assoc()['total'];
    $orders_new = $conn->query("SELECT COUNT(*) as total FROM pesanan WHERE tanggal >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetch_assoc()['total'];
    $total_earning = $conn->query("SELECT SUM(harga * jumlah) as total FROM pesanan_detail")->fetch_assoc()['total'];

    // Data Chart Line - Jumlah Pesanan per Hari (7 Hari Terakhir)
    $lineData = [];
    $result = $conn->query("
        SELECT DATE(tanggal) as tgl, COUNT(*) as total 
        FROM pesanan 
        WHERE tanggal >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        GROUP BY DATE(tanggal)
    ");
    while($row = $result->fetch_assoc()) {
        $lineData[] = ["tanggal" => $row['tgl'], "jumlah" => (int)$row['total']];
    }

    // Data Chart Bar - Earning per Minggu (4 Minggu Terakhir)
    $barData = [];
    $result = $conn->query("
        SELECT WEEK(tanggal) as minggu, SUM(harga * jumlah) as total 
        FROM pesanan 
        JOIN pesanan_detail ON pesanan.id = pesanan_detail.pesanan_id
        WHERE tanggal >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
        GROUP BY WEEK(tanggal)
    ");
    while($row = $result->fetch_assoc()) {
        $barData[] = ["minggu" => "Minggu " . $row['minggu'], "total" => (int)$row['total']];
    }

    // Data Omzet per Bulan
    $omzet_query = "SELECT DATE_FORMAT(p.tanggal, '%Y-%m') AS bulan, SUM(pd.harga * pd.jumlah) AS total_omzet 
                    FROM pesanan p 
                    JOIN pesanan_detail pd ON p.id = pd.pesanan_id 
                    GROUP BY bulan ORDER BY bulan";
    $omzet_result = $conn->query($omzet_query);

    $bulan = [];
    $omzet = [];
    while ($row = $omzet_result->fetch_assoc()) {
        $bulan[] = $row['bulan'];
        $omzet[] = $row['total_omzet'];
    }

    // Data Produk Terlaris
    $produk_query = "SELECT nama, SUM(jumlah) AS total_terjual 
                    FROM pesanan_detail 
                    GROUP BY nama 
                    ORDER BY total_terjual DESC LIMIT 5";
    $produk_result = $conn->query($produk_query);

    $produk = [];
    $jumlah = [];
    while ($row = $produk_result->fetch_assoc()) {
        $produk[] = $row['nama'];
        $jumlah[] = $row['total_terjual'];
    }
?>

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
                <a href="#" class="text-white font-bold text-xl no-underline">Cemal-Cemil</a>
            </div>
            <div class="flex items-end">
                <a href="#" class="text-white hover:text-yellow-300">
                Welcome, <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest' ?>
                </a>
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
            <a href="#" class="text-white hover:text-yellow-300">
                Admin <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest' ?>
                </a>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="produkAdmin.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Produk</a>
            <a href="historyStok.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Stok Produk</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Penjualan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Keuangan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Daftar Pelanggan</a>
            <a href="#" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Kelola Admin</a>
            <a href="logout.php" class="bg-green-600 hover:bg-green-800 text-white hover:text-yellow-400 px-4 py-2 rounded-md transition">Keluar</a>
        </div>
    </div>
    <!-- Informasi singkat -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded-lg shadow">
        <p class="text-green-800 font-semibold">Orders Received</p>
        <p class="text-3xl font-bold"><?= $orders_total ?></p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg shadow">
        <p class="text-purple-800 font-semibold">Completed Orders</p>
        <p class="text-3xl font-bold"><?= $orders_total ?></p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
        <p class="text-yellow-800 font-semibold">New Orders</p>
        <p class="text-3xl font-bold"><?= $orders_new ?></p>
        </div>
        <div class="bg-blue-100 p-4 rounded-lg shadow">
        <p class="text-blue-800 font-semibold">Total Earning</p>
        <p class="text-3xl font-bold">Rp<?= number_format($total_earning, 0, ',', '.') ?></p>
        </div>
    </div>

  <!-- Section: Chart 2x2 Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Line Chart -->
      <div class="bg-white p-4 rounded-lg shadow h-[320px]">
        <h2 class="text-md font-semibold mb-2 text-green-700">Pesanan 7 Hari Terakhir</h2>
        <canvas id="lineChart" class="max-h-[200px] w-full"></canvas>
      </div>

      <!-- Bar Chart Weekly -->
      <div class="bg-white p-4 rounded-lg shadow h-[320px]">
        <h2 class="text-md font-semibold mb-2 text-green-700">Pendapatan per Minggu</h2>
        <canvas id="barChart" class="max-h-[200px] w-full"></canvas>
      </div>

      <!-- Bar Chart Monthly -->
      <div class="bg-white p-4 rounded-lg shadow h-[320px]">
        <h2 class="text-md font-semibold mb-2 text-green-700">Omzet Bulanan</h2>
        <canvas id="omzetChart" class="max-h-[200px] w-full"></canvas>
      </div>

      <!-- Pie Chart -->
      <div class="bg-white p-4 rounded-lg shadow h-[320px]">
        <h2 class="text-md font-semibold mb-2 text-green-700">Produk Terlaris</h2>
        <canvas id="produkChart" class="max-h-[200px] w-full"></canvas>
      </div>
    </div>

    <script>
    const lineChart = new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: {
        labels: <?= json_encode(array_column($lineData, 'tanggal')) ?>,
        datasets: [{
          label: 'Jumlah Pesanan',
          data: <?= json_encode(array_column($lineData, 'jumlah')) ?>,
          borderColor: '#22c55e',
          backgroundColor: '#bbf7d0',
          fill: true,
          tension: 0.4
        }]
      }
    });

    const barChart = new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_column($barData, 'minggu')) ?>,
        datasets: [{
          label: 'Pendapatan',
          data: <?= json_encode(array_column($barData, 'total')) ?>,
          backgroundColor: '#22c55e'
        }]
      }
    });

    const omzetCtx = document.getElementById('omzetChart').getContext('2d');
    const omzetChart = new Chart(omzetCtx, {
        type: 'bar',
        data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [{
            label: 'Omzet',
            data: <?= json_encode($omzet) ?>,
            backgroundColor: 'rgba(34,197,94,0.6)',
            borderColor: 'rgba(34,197,94,1)',
            borderWidth: 1
        }]
        }
    });

    const produkCtx = document.getElementById('produkChart').getContext('2d');
    const produkChart = new Chart(produkCtx, {
        type: 'pie',
        data: {
        labels: <?= json_encode($produk) ?>,
        datasets: [{
            label: 'Produk Terlaris',
            data: <?= json_encode($jumlah) ?>,
            backgroundColor: [
            '#34D399', '#60A5FA', '#FBBF24', '#F87171', '#A78BFA'
            ]
        }]
        }
    });
    </script>

</body>
</html>