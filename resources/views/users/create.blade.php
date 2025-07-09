<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Tambah User
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-300">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Saldo</label>
                    <input type="number" name="saldo" value="{{ old('saldo') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Role</label>
                    <select name="role" class="w-full border border-gray-300 rounded px-4 py-2" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>
    </div>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</x-app-layout>
