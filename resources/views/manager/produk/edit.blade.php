@extends('manager.layout')
@section('title','Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

@if($errors->any())
<div class="bg-red-100 p-4 rounded mb-4">
    <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('manager.produk.update', $produk->id_produk) }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block font-semibold">Nama Produk</label>
        <input type="text" name="nama_produk" class="border p-2 w-full" value="{{ old('nama_produk',$produk->nama_produk) }}" required>
    </div>
    <div>
        <label class="block font-semibold">Kategori</label>
        <select name="id_kategori" class="border p-2 w-full" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id_kategori }}" {{ old('id_kategori',$produk->id_kategori)==$k->id_kategori?'selected':'' }}>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block font-semibold">Harga</label>
        <input type="number" name="harga" class="border p-2 w-full" value="{{ old('harga',$produk->harga) }}" required>
    </div>
    <div>
        <label class="block font-semibold">Stok</label>
        <input type="number" name="stok" class="border p-2 w-full" value="{{ old('stok',$produk->stok) }}" required>
    </div>
    <div class="col-span-2">
        <label class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi_produk" class="border p-2 w-full">{{ old('deskripsi_produk',$produk->deskripsi_produk) }}</textarea>
    </div>
    <div class="col-span-2">
        <label class="block font-semibold">Gambar Produk</label>
        <input type="file" name="gambar_produk" accept="image/*" onchange="previewImage(event)">
        @if($produk->gambar_produk)
            <img id="preview" src="{{ asset('storage/'.$produk->gambar_produk) }}" class="mt-2 w-32 h-32 object-cover">
        @else
            <img id="preview" class="mt-2 w-32 h-32 object-cover hidden">
        @endif
    </div>
    <div class="col-span-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Produk</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    let preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('hidden');
}
</script>
@endsection
