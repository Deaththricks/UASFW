@extends('manager.layout')
@section('title','Tambah User')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah User</h2>

<form method="POST" action="{{ route('manager.users.store') }}" class="grid grid-cols-2 gap-4">
@csrf
<input name="user_name" placeholder="Username" class="border p-2" required>
<input name="email" type="email" placeholder="Email" class="border p-2" required>
<input name="password" type="password" placeholder="Password" class="border p-2" required>
<input name="nama_lengkap" placeholder="Nama Lengkap" class="border p-2" required>
<input name="no_hp" placeholder="No HP" class="border p-2">
<input name="alamat" placeholder="Alamat" class="border p-2">

<select name="role" class="border p-2 col-span-2" required>
    <option value="">-- Pilih Role --</option>
    <option value="manager">Manager</option>
    <option value="staff">Staff</option>
    <option value="pelanggan">Pelanggan</option>
</select>

<button class="bg-[#e8b44a] text-white px-4 py-2 rounded col-span-2">
    Simpan
</button>
</form>
@endsection
