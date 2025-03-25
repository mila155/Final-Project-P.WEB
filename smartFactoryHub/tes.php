export default function Dashboard() {
  return (
    <div className="min-h-screen bg-gray-100 p-6">
      <div className="max-w-7xl mx-auto">
        <header className="bg-white shadow-md p-4 rounded-xl mb-6 flex justify-between items-center">
          <h1 className="text-xl font-bold text-gray-800">SmartFactory Hub</h1>
          <button className="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Logout</button>
        </header>

        <main className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <Card title="Manajemen Inventaris" description="Kelola stok bahan dan produk dengan mudah." />
          <Card title="Manajemen Produksi" description="Pantau dan optimalkan proses produksi." />
          <Card title="Pencatatan Keuangan" description="Catat transaksi dan analisis keuangan." />
          <Card title="Dashboard Analitik" description="Lihat insight bisnis secara real-time." />
        </main>
      </div>
    </div>
  );
}

function Card({ title, description }) {
  return (
    <div className="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
      <h2 className="text-lg font-semibold text-gray-800 mb-2">{title}</h2>
      <p className="text-gray-600">{description}</p>
    </div>
  );
}