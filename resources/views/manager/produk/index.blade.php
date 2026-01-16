@extends('manager.layout')
@section('title','Daftar Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Produk</h1>
    <a href="{{ route('manager.produk.create') }}"
       class="bg-[#e8b44a] hover:bg-blue-600 text-white px-5 py-2 rounded shadow transition duration-200">
        Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 shadow">
        {{ session('success') }}
    </div>
@endif

<div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
    @foreach ($produks as $p)
    <div class="bg-white rounded-lg shadow hover:shadow-xl transition flex flex-col overflow-hidden">
        <div class="h-40 bg-gray-100 flex items-center justify-center overflow-hidden">
            @if($p->gambar_produk)
                <img src="{{ asset('storage/'.$p->gambar_produk) }}"
                     class="h-full w-full object-cover hover:scale-105 transition-transform duration-300">
            @else
                <span class="text-gray-400">No Image</span>
            @endif
        </div>

        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <h3 class="font-semibold text-lg text-[#e8b44a]">
                    {{ $p->nama_produk }}
                </h3>
                <p class="text-sm text-gray-500 mt-1 truncate">
                    {{ $p->deskripsi_produk }}
                </p>
                <p class="text-sm text-gray-400 mt-1">
                    Kategori: {{ $p->kategori->nama_kategori ?? '-' }}
                </p>
            </div>

            <div class="mt-3">
                <p class="font-bold text-[#e8b44a]">
                    Rp {{ number_format($p->harga,0,',','.') }}
                </p>
                <p class="text-sm text-gray-600">
                    Stok: {{ $p->stok }}
                </p>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('manager.produk.edit', $p->id_produk) }}"
                   class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('manager.produk.destroy', $p->id_produk) }}"
                      class="delete-form">
                    @csrf
                    @method('DELETE')

                    <!-- PENTING: type="button" -->
                    <button type="button"
                            class="delete-btn text-red-500 hover:text-red-700 text-sm font-medium">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6 flex justify-center">
    {{ $produks->links('pagination::tailwind') }}
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Yakin hapus produk ini?',
                text: 'Data produk akan hilang permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
