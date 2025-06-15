<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title> 

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
</x-layout>