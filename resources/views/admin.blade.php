<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alata&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Geist:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Sofia+Sans+Semi+Condensed:ital,wght@0,1..1000;1,1..1000&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
    </style>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard Admin</title>
</head>
<body>

    <x-adminnav></x-adminnav>

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-green-100 p-4 rounded shadow">
                <p class="text-green-800 font-semibold">Orders Received</p>
                <p class="text-3xl font-bold">{{ $orders_total }}</p>
            </div>
            <div class="bg-purple-100 p-4 rounded shadow">
                <p class="text-purple-800 font-semibold">Completed Orders</p>
                <p class="text-3xl font-bold">{{ $orders_total }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded shadow">
                <p class="text-yellow-800 font-semibold">New Orders</p>
                <p class="text-3xl font-bold">{{ $orders_new }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded shadow">
                <p class="text-blue-800 font-semibold">Total Earning</p>
                <p class="text-3xl font-bold">Rp{{ number_format($total_earning, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold text-green-700 mb-2">Pesanan 7 Hari Terakhir</h3>
                <canvas id="lineChart"></canvas>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold text-green-700 mb-2">Pendapatan per Minggu</h3>
                <canvas id="barChart"></canvas>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold text-green-700 mb-2">Omzet Bulanan</h3>
                <canvas id="omzetChart"></canvas>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold text-green-700 mb-2">Produk Terlaris</h3>
                <canvas id="produkChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const lineChart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($lineData->pluck('tanggal')) !!},
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: {!! json_encode($lineData->pluck('jumlah')) !!},
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
                labels: {!! json_encode($barData->pluck('minggu')->map(fn($v) => 'Minggu ' . $v)) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($barData->pluck('total')) !!},
                    backgroundColor: '#22c55e'
                }]
            }
        });

        const omzetChart = new Chart(document.getElementById('omzetChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($omzetData->pluck('bulan')) !!},
                datasets: [{
                    label: 'Omzet',
                    data: {!! json_encode($omzetData->pluck('total_omzet')) !!},
                    backgroundColor: 'rgba(34,197,94,0.6)',
                    borderColor: 'rgba(34,197,94,1)',
                    borderWidth: 1
                }]
            }
        });

        const produkChart = new Chart(document.getElementById('produkChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($produkData->pluck('nama_produk')) !!},
                datasets: [{
                    data: {!! json_encode($produkData->pluck('total_terjual')) !!},
                    backgroundColor: ['#34D399', '#60A5FA', '#FBBF24', '#F87171', '#A78BFA']
                }]
            }
        });
    </script>

    <x-footer></x-footer>
    
</body>
</html>