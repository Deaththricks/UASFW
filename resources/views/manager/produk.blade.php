@extends('manager.layout')

@section('title', 'Kelola Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola Produk</h1>

<div class="mb-8 p-4 bg-white rounded shadow">
    <h2 class="font-bold mb-2">Tambah Produk Baru</h2>
    <form method="POST" action="{{ route('manager.produk.store') }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="nama_produk" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block font-semibold">Kategori</label>
            <select name="id_kategori" class="border p-2 w-full" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block font-semibold">Stok</label>
            <input type="number" name="stok" class="border p-2 w-full" required>
        </div>
        <div class="col-span-2">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi_produk" class="border p-2 w-full"></textarea>
        </div>
        <div class="col-span-2">
            <label class="block font-semibold">Gambar Produk</label>
            <input type="file" name="gambar_produk" accept="image/*" onchange="previewImage(event)">
            <img id="preview" class="mt-2 w-32 h-32 object-cover hidden">
        </div>
        <div class="col-span-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Simpan Produk</button>
        </div>
    </form>
</div>

<div class="grid grid-cols-4 gap-6">
@foreach ($produks as $p)
    <div class="bg-white rounded shadow overflow-hidden">
        <div class="h-40 bg-gray-200 flex items-center justify-center">
            @if ($p->gambar_produk)
                <img src="{{ asset('storage/'.$p->gambar_produk) }}" class="h-full w-full object-cover">
            @else
                <span class="text-gray-400">No Image</span>
            @endif
        </div>

        <div class="p-4">
            <h3 class="font-bold">{{ $p->nama_produk }}</h3>
            <p class="text-sm text-gray-500 line-clamp-2">{{ $p->deskripsi_produk }}</p>
            <p class="text-sm text-gray-400 mt-1">Kategori: {{ $p->kategori->nama_kategori ?? '-' }}</p>

            <div class="mt-3">
                <p class="font-semibold text-blue-600">Rp {{ number_format($p->harga,0,',','.') }}</p>
                <p class="text-sm">Stok: {{ $p->stok }}</p>
            </div>

            <div class="mt-4 flex gap-2">
                <button type="button" 
                    onclick="openEditModal(this)"
                    data-id="{{ $p->id }}" 
                    data-nama="{{ $p->nama_produk }}" 
                    data-kategori="{{ $p->id_kategori }}" 
                    data-harga="{{ $p->harga }}" 
                    data-stok="{{ $p->stok }}" 
                    data-deskripsi="{{ $p->deskripsi_produk }}" 
                    class="text-blue-500 hover:underline text-sm font-medium">
                    Edit
                </button>

                <form method="POST" action="{{ route('manager.produk.destroy', $p) }}" onsubmit="return confirm('Yakin hapus produk ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline text-sm font-medium">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>

<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="font-bold text-xl mb-4">Edit Produk</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Nama Produk</label>
                    <input type="text" name="nama_produk" id="edit_nama_produk" class="border p-2 w-full" required>
                </div>
                <div>
                    <label class="block font-semibold">Kategori</label>
                    <select name="id_kategori" id="edit_id_kategori" class="border p-2 w-full" required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Harga</label>
                    <input type="number" name="harga" id="edit_harga" class="border p-2 w-full" required>
                </div>
                <div>
                    <label class="block font-semibold">Stok</label>
                    <input type="number" name="stok" id="edit_stok" class="border p-2 w-full" required>
                </div>
                <div class="col-span-2">
                    <label class="block font-semibold">Deskripsi</label>
                    <textarea name="deskripsi_produk" id="edit_deskripsi_produk" class="border p-2 w-full"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="block font-semibold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar_produk" accept="image/*" onchange="previewEditImage(event)">
                    <img id="edit_preview" class="mt-2 w-32 h-32 object-cover hidden border">
                </div>
                <div class="col-span-2 flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Produk</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Logic for New Product Preview
function previewImage(event) {
    let preview = document.getElementById('preview');
    if(event.target.files.length > 0){
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.classList.remove('hidden');
    }
}

// Logic for Edit Product Preview
function previewEditImage(event) {
    let preview = document.getElementById('edit_preview');
    if(event.target.files.length > 0){
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.classList.remove('hidden');
    }
}

/**
 * FIXED: Uses the button element (btn) to pull data-attributes 
 * instead of passing 6 loose arguments.
 */
function openEditModal(btn) {
    const data = btn.dataset;
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    // Update form action URL dynamically
    form.action = '/manager/produk/' + data.id;

    // Fill form inputs
    document.getElementById('edit_nama_produk').value = data.nama;
    document.getElementById('edit_id_kategori').value = data.kategori;
    document.getElementById('edit_harga').value = data.harga;
    document.getElementById('edit_stok').value = data.stok;
    document.getElementById('edit_deskripsi_produk').value = data.deskripsi;

    // Reset and show modal
    document.getElementById('edit_preview').classList.add('hidden');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close modal when clicking outside the white box
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        closeEditModal();
    }
}
</script>
@endsection