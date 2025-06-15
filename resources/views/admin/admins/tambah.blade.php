<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg my-10 py-10 shadow-lg">
        <h2 class="text-2xl font-bold text-green-700 mb-4">Tambah Admin Baru</h2>

        @if ($errors->any())
            <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="user_name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" value="{{ old('user_name') }}">
                @error('user_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="user_email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" value="{{ old('user_email') }}">
                @error('user_email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="user_password" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500">
                @error('user_password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="user_password_confirmation" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500">
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">Tambah Admin</button>
            <p class="text-center mt-4 text-gray-600">
                <a href="{{ route('admins.index') }}" class="text-green-600 hover:underline">Kembali</a>
            </p>
        </form>
    </div>
</x-layout>