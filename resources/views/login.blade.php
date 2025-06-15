<x-layout>
  <x-navbar></x-navbar>
  <x-slot:title>{{ $title }}</x-slot:title>
  
  <div class="flex h-screen items-center justify-center">
    <div class="bg-white bg-opacity-90 rounded-lg shadow-lg flex w-full max-w-4xl mx-auto overflow-hidden">
        <!-- Form Login -->
        <div class="w-full md:w-3/4 py-8 mx-10">
          <h2 class="text-2xl font-bold text-center text-green-600">Login ke Cemal Cemil</h2>
          <p class="text-center text-gray-500 mb-4"></p>
    
          <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <div class="relative">
                  <input type="password" id="password" name="password" placeholder="Masukkan password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" />
                  <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:text-gray-900"> 👁️ </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <button type="submit" name="login" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 font-medium hover:scale-105 transition ease-in-out delay-150">Login</button>
          </form>
    
          <p class="text-center text-gray-600 mt-4">
            Belum punya akun? <a href="/register" class="text-green-600 hover:underline">Daftar di sini</a>
          </p>
        </div>
    
        <!-- Gambar Samping -->
        <div class="hidden md:block w-1/2 bg-cover bg-right rounded-r-lg">
        <img src="./img/logolengkapnew.png" alt="Logo" class="object-contain max-w-72 max-h-72">
        </div>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
  </script>
</x-layout>