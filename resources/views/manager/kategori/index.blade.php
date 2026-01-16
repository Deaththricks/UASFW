@extends('manager.layout')
@section('title','Kelola Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Kelola Kategori</h1>
    <a href="{{ route('manager.kategori.create') }}"
       class="bg-[#e8b44a] text-white px-4 py-2 rounded">
        + Tambah Kategori
    </a>
</div>

@if(session('error'))
<div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
    {{ session('error') }}
</div>
@endif

<table class="w-full bg-white rounded shadow">
    <thead class="bg-[#e8b44a]">
        <tr>
            <th class="p-3 text-left">Nama Kategori</th>
            <th class="text-left">Deskripsi</th>
            <th width="120">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kategoris as $k)
        <tr class="border-t">
            <td class="p-3 font-semibold">{{ $k->nama_kategori }}</td>
            <td>{{ $k->deskripsi_kategori ?? '-' }}</td>
            <td class="flex gap-3 p-2">
                <a href="{{ route('manager.kategori.edit',$k) }}"
                   class="text-blue-600">✏️</a>

                <form method="POST"
                      action="{{ route('manager.kategori.destroy',$k) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus kategori ini?')"
                        class="text-red-600">🗑️</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
