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
    <title>Login</title>
</head>
<body class="h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg flex w-full max-w-4xl overflow-hidden">
        <div class="w-full lg:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-green-700 mb-2 text-center">Register Akun Cemal Cemil</h2>
            
            <form id="registrationForm" action="{{ route('register.submit') }}" method="POST" class="space-y-4">
                @csrf
                @if (session('success'))
                    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label class="block text-gray-700 text-sm font-bold" for="nama">Nama</label>
                <input type="text" name="user_name" value="{{ old('user_name') }}" required placeholder="Masukkan Nama lengkap" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />

                <label class="block text-gray-700 text-sm font-bold" for="nama">Nomor Telepon</label>
                <input type="text" name="user_telp" value="{{ old('user_telp') }}" required placeholder="Masukkan Nomor telepon" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />

                <label class="block text-gray-700 text-sm font-bold" for="nama">Email</label>
                <input type="email" name="user_email" value="{{ old('user_email') }}" required placeholder="Masukkan Email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />

                <label class="block text-gray-700 text-sm font-bold" for="nama">Password</label>
                <input type="password" name="user_password" required placeholder="Masukkan Password" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />

                <label class="block text-gray-700 text-sm font-bold" for="nama">Konfirmasi Password</label>
                <input type="password" name="user_password_confirmation" required placeholder="Masukkan Password Konfirmasi" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
                
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold">Daftar</button>
            </form>

            <p class="text-center text-gray-600 mt-4">Sudah punya akun? <a href="/login" class="text-green-600 hover:underline">Login</a></p>

        </div>

        <div class="hidden lg:block w-1/2 rounded-r-lg items-center justify-center p-4">
            <img src="./img/logonew.png" alt="Logo" class="object-contain h-full w-full">
        </div>
    </div>
</body>
</html>