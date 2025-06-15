<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg my-10 py-10 shadow-lg">
        <h2 class="text-2xl font-bold text-green-700 mb-4">Edit Data Admin</h2>

        @if ($errors->any())
            <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.update', $user->user_id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="user_name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" value="{{ old('user_name', $user->user_name) }}">
                @error('user_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="user_email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" value="{{ old('user_email', $user->user_email) }}">
                @error('user_email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            <a href="{{ route('admins.index') }}" class="ml-4 text-green-600 hover:underline">Batal</a>
        </form>
    </div>
</x-layout>