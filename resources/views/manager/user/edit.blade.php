@extends('manager.layout')
@section('title','Edit User')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit User</h2>

<form method="POST" action="{{ route('manager.users.update',$user) }}" class="grid grid-cols-2 gap-4">
@csrf
@method('PUT')

<input value="{{ $user->nama_lengkap }}" name="nama_lengkap" class="border p-2" required>
<input value="{{ $user->no_hp }}" name="no_hp" class="border p-2">
<input value="{{ $user->alamat }}" name="alamat" class="border p-2">

<select name="role" class="border p-2">
    <option value="manager" {{ $user->role=='manager'?'selected':'' }}>Manager</option>
    <option value="staff" {{ $user->role=='staff'?'selected':'' }}>Staff</option>
    <option value="pelanggan" {{ $user->role=='pelanggan'?'selected':'' }}>Pelanggan</option>
</select>

<select name="status" class="border p-2">
    <option value="1" {{ $user->status?'selected':'' }}>Aktif</option>
    <option value="0" {{ !$user->status?'selected':'' }}>Nonaktif</option>
</select>

<button class="bg-green-600 text-white px-4 py-2 rounded col-span-2">
    Update
</button>
</form>
@endsection
