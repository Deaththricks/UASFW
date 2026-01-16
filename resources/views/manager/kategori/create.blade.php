@extends('manager.layout')
@section('title','Tambah Kategori')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>

<form method="POST"
      action="{{ route('manager.kategori.store') }}"
      class="bg-white p-6 rounded shadow w-1/2">
@csrf

<label class="block mb-2 font-semibold">Nama Kategori</label>
<input name="nama_kategori"
       class="border p-2 w-full mb-4" required>

<label class="block mb-2 font-semibold">Deskripsi</label>
<textarea name="deskripsi_kategori"
          class="border p-2 w-full mb-4"></textarea>

<button class="bg-[#e8b44a] text-white px-4 py-2 rounded">
    Simpan
</button>
</form>
@endsection
