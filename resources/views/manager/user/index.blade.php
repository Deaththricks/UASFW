<style>
    th {
        text-align: left;
    }
</style>

@extends('manager.layout')
@section('title','Kelola User')

@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">Kelola User</h2>
    <a href="{{ route('manager.users.create') }}" class="bg-[#e8b44a] text-white px-4 py-2 rounded">
        + Tambah User
    </a>
</div>

<form method="GET" class="flex gap-3 mb-4">
    <input type="text" name="search" placeholder="Cari user..."
        class="border px-3 py-2 rounded">
    <select name="role" class="border px-3 py-2 rounded">
        <option value="">Semua Role</option>
        <option value="manager">Manager</option>
        <option value="staff">Staff</option>
        <option value="pelanggan">Pelanggan</option>
    </select>
    <button class="bg-[#e8b44a] text-white px-4 rounded">Cari</button>
</form>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-[#e8b44a]">
        <tr>
            <th class="p-3">Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
        <tr class="border-t">
            <td class="p-3">{{ $u->user_name }}</td>
            <td>{{ $u->nama_lengkap }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->no_hp }}</td>
            <td>{{ ucfirst($u->role) }}</td>
            <td>{{ $u->status ? 'Aktif' : 'Nonaktif' }}</td>
            <td class="flex gap-2 p-2">
                <a href="{{ route('manager.users.edit',$u) }}" class="text-blue-600">✏️</a>

                <form method="POST" action="{{ route('manager.users.destroy',$u) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus user ini?')" class="text-red-600">🗑️</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
