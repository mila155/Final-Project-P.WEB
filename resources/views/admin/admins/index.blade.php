<x-layout>
    <x-adminnav></x-adminnav>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg my-10 py-10 shadow-lg">
        <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Kelola Admin</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('admins.create') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 mb-4">Tambah Admin</a>

        @if ($admins->isNotEmpty())
            <h3 class="text-xl font-semibold text-green-700 mt-8 mb-2">Daftar Admin Saat Ini</h3>
            <div class="overflow-x-auto">
                <table class="w-full border text-sm text-left text-gray-600 mt-2">
                    <thead class="bg-green-100 text-green-800">
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ htmlspecialchars($admin->user_name) }}</td>
                                <td class="px-4 py-2 border">{{ htmlspecialchars($admin->user_email) }}</td>
                                <td class="px-4 py-2 border flex gap-2">
                                    <a href="{{ route('admins.edit', $admin->user_id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admins.destroy', $admin->user_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-600 mt-4">Belum ada admin terdaftar.</p>
        @endif

        <p class="text-center mt-4 text-gray-600">
            <a href="{{ route('admin') }}" class="text-green-600 hover:underline">Kembali ke Dashboard</a>
        </p>
    </div>
</x-layout>