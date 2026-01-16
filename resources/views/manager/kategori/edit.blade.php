@extends('manager.layout')
@section('title','Edit Kategori')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

<form method="POST"
      action="{{ route('manager.kategori.update',$kategori) }}"
      class="bg-white p-6 rounded shadow w-1/2">
@csrf
@method('PUT')

<label class="block mb-2 font-semibold">Nama Kategori</label>
<input name="nama_kategori"
       value="{{ $kategori->nama_kategori }}"
       class="border p-2 w-full mb-4" required>

<label class="block mb-2 font-semibold">Deskripsi</label>
<textarea name="deskripsi_kategori"
          class="border p-2 w-full mb-4">{{ $kategori->deskripsi_kategori }}</textarea>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Update
</button>
</form>
@endsection
