<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Responsif</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Buat Akun</h1>
        <form id="registrationForm">
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                    Nama Perusahaan
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" type="text" placeholder="Nama Perusahaan" required>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                    Alamat
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" type="text" placeholder="Alamat" required>
            </div>

            <!-- No. Telp -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nomer">
                    No. Telpon
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomer" type="text" placeholder="Nomer" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password" required>
            </div>

            <!-- Tombol Daftar -->
            <div class="flex items-center justify-center mt-5">
                <button class="bg-orange-500 hover:bg-orange-900 text-white font-bold py-2 px-40 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Daftar
                </button>
            </div>
        </form>
    </div>

    <!-- Pop-up Sukses -->
    <div id="successModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Pendaftaran Berhasil!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Akun Anda telah berhasil didaftarkan.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="okButton" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <a href="login.php">OK</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up Gagal -->
    <div id="errorModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Pendaftaran Gagal!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Terjadi kesalahan saat mendaftarkan akun. Silakan coba lagi.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeErrorButton" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tangani submit form
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form submit default

            // Ambil nilai dari form
            const namaPerusahaan = document.getElementById('nama').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const nomer = document.getElementById('nomer').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            
            // Validasi sederhana
            if (namaPerusahaan && alamat && nomer && email && password) {
                // Jika semua field terisi, tampilkan pop-up sukses
            document.getElementById('successModal').classList.remove('hidden');
            } else {
                // Jika ada field yang kosong, tampilkan pop-up gagal
            document.getElementById('errorModal').classList.remove('hidden');
            }
        });

        // Tutup pop-up sukses
        document.getElementById('okButton').addEventListener('click', function() {
            document.getElementById('successModal').classList.add('hidden');
        });

        // Tutup pop-up gagal
        document.getElementById('closeErrorButton').addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });
    </script>
</body>
</html>