@extends('manager.layout')
@section('title','Tambah Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

@if($errors->any())
<div class="bg-red-100 p-4 rounded mb-4">
    <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('manager.produk.store') }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
    @csrf
    <div>
        <label class="block font-semibold">Nama Produk</label>
        <input type="text" name="nama_produk" class="border p-2 w-full" value="{{ old('nama_produk') }}" required>
    </div>
    <div>
        <label class="block font-semibold">Kategori</label>
        <select name="id_kategori" class="border p-2 w-full" required>
            @if($kategoris->count() == 0)
                <option value="">Tidak ada kategori</option>
            @else
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div>
        <label class="block font-semibold">Harga</label>
        <input type="number" name="harga" class="border p-2 w-full" value="{{ old('harga') }}" required>
    </div>
    <div>
        <label class="block font-semibold">Stok</label>
        <input type="number" name="stok" class="border p-2 w-full" value="{{ old('stok') }}" required>
    </div>
    <div class="col-span-2">
        <label class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi_produk" class="border p-2 w-full">{{ old('deskripsi_produk') }}</textarea>
    </div>
    <div class="col-span-2">
        <label class="block font-semibold">Gambar Produk</label>
        <input type="file" name="gambar_produk" accept="image/*" onchange="previewImage(event)">
        <img id="preview" class="mt-2 w-32 h-32 object-cover hidden">
    </div>
    <div class="col-span-2">
        <button type="submit" class="bg-[#e8b44a] text-white px-4 py-2 rounded">Simpan Produk</button>
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
