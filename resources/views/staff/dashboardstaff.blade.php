@extends('layouts.adminstaff')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-[#5C3D2E]">Panel Staff L’ZA BAKERY</h2>
    <p class="text-slate-500 mt-1">Kelola pesanan, verifikasi pembayaran, dan perbarui status pesanan</p>
</div>

<div class="grid grid-cols-12 gap-6">
    
    <div class="col-span-12 lg:col-span-5 flex flex-col gap-4">
        <div class="bg-white rounded-3xl shadow-sm border border-orange-50/50 overflow-hidden flex flex-col h-[750px]">
            <div class="p-6 border-b border-slate-50">
                <h3 class="font-bold text-lg mb-4">Daftar Pesanan</h3>
                <div class="flex gap-2 overflow-x-auto pb-2 custom-scrollbar">
                    @php 
                        $statuses = [
                            null => ['label' => 'Semua', 'color' => 'bg-[#E6B37E]'],
                            'menunggu' => ['label' => 'Menunggu', 'color' => 'bg-orange-400'],
                            'terverifikasi' => ['label' => 'Terverifikasi', 'color' => 'bg-blue-500'],
                            'diproses' => ['label' => 'Diproses', 'color' => 'bg-indigo-500'],
                            'selesai' => ['label' => 'Selesai', 'color' => 'bg-emerald-500'],
                            'dibatalkan' => ['label' => 'Batal', 'color' => 'bg-rose-500'],
                        ];
                    @endphp

                    @foreach($statuses as $key => $val)
                        <a href="{{ route('staff.dashboard.index', ['status' => $key, 'search' => request('search')]) }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all {{ (request('status') == $key) ? $val['color'].' text-white shadow-md' : 'bg-slate-50 text-slate-500 hover:bg-orange-50' }}">
                            {{ $val['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="overflow-y-auto flex-1 custom-scrollbar">
                @forelse($pesanans as $item)
                <div class="p-5 border-b border-slate-50 cursor-pointer transition-all hover:bg-orange-50/30 group {{ (isset($pesananTerpilih) && $pesananTerpilih->id_pesanan == $item->id_pesanan) ? 'bg-orange-50/60 border-r-4 border-r-orange-400' : '' }}" 
                     onclick="window.location='{{ route('staff.dashboard.show', $item->id_pesanan) }}?status={{ request('status') }}&search={{ request('search') }}'">
                    
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">ORD-{{ str_pad($item->id_pesanan, 4, '0', STR_PAD_LEFT) }}</span>
                            <h4 class="font-bold text-slate-700 group-hover:text-orange-800">{{ $item->user->nama_lengkap }}</h4>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider
                            {{ $item->status_pesanan == 'menunggu' ? 'bg-orange-100 text-orange-600' : '' }}
                            {{ $item->status_pesanan == 'terverifikasi' ? 'bg-blue-100 text-blue-600' : '' }}
                            {{ $item->status_pesanan == 'diproses' ? 'bg-indigo-100 text-indigo-600' : '' }}
                            {{ $item->status_pesanan == 'selesai' ? 'bg-emerald-100 text-emerald-600' : '' }}
                            {{ $item->status_pesanan == 'dibatalkan' ? 'bg-rose-100 text-rose-600' : '' }}">
                            {{ $item->status_pesanan }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center gap-3 text-[10px] text-slate-400 font-medium">
                            <span>📅 {{ $item->created_at->format('d M, H:i') }}</span>
                            <span>📦 {{ $item->details->count() }} Item</span>
                        </div>
                        <span class="text-sm font-extrabold text-[#5C3D2E]">Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center h-full text-slate-400 p-10 opacity-60">
                    <span class="text-5xl mb-4">📭</span>
                    <p class="font-bold">Tidak ada pesanan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-7">
        @if(isset($pesananTerpilih))
            <div class="bg-white rounded-3xl shadow-sm border border-orange-50/50 p-8 sticky top-24">
                <div class="flex justify-between items-center mb-8 pb-6 border-b border-slate-50">
                    <div>
                        <h3 class="text-2xl font-black text-[#5C3D2E]">Detail Pesanan</h3>
                        <p class="text-slate-400 text-sm">ID Transaksi: <span class="font-bold text-orange-600">#ORD{{ $pesananTerpilih->id_pesanan }}</span></p>
                    </div>
                    <div class="text-right">
                         <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Saat Ini</p>
                         <span class="px-4 py-1.5 rounded-xl text-xs font-bold bg-slate-100 text-slate-600 uppercase">{{ $pesananTerpilih->status_pesanan }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] uppercase font-black text-slate-400 tracking-tighter mb-2 text-center border-b border-slate-200 pb-1">Data Pelanggan</p>
                        <p class="font-bold text-slate-700 text-center">{{ $pesananTerpilih->user->nama_lengkap }}</p>
                        <p class="text-xs text-center text-slate-500 mt-1">📞 {{ $pesananTerpilih->user->no_hp ?? '-' }}</p>
                    </div>
                    <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] uppercase font-black text-slate-400 tracking-tighter mb-2 text-center border-b border-slate-200 pb-1">Waktu Pesan</p>
                        <p class="font-bold text-slate-700 text-center">{{ $pesananTerpilih->created_at->format('d F Y') }}</p>
                        <p class="text-xs text-center text-slate-500 mt-1">🕒 {{ $pesananTerpilih->created_at->format('H:i') }} WIB</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-4">Ringkasan Pesanan</p>
                    <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($pesananTerpilih->details as $detail)
                        <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-slate-50 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-lg">🍞</div>
                                <div>
                                    <p class="font-bold text-slate-700 text-sm">{{ $detail->produk->nama_produk }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold">{{ $detail->jumlah }} Pcs x Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-slate-700 text-sm">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#5C3D2E] rounded-2xl p-6 flex justify-between items-center mb-8 shadow-xl shadow-orange-100">
                    <span class="font-bold text-orange-200 uppercase text-xs tracking-widest">Total Pembayaran</span>
                    <span class="text-2xl font-black text-white">Rp {{ number_format($pesananTerpilih->total_pembayaran, 0, ',', '.') }}</span>
                </div>

                <div class="space-y-3">
                    <button onclick="toggleModal('paymentModal', '{{ asset('storage/' . $pesananTerpilih->bukti_pembayaran) }}')"
                            class="w-full h-14 bg-slate-100 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-200 transition-all flex items-center justify-center gap-3">
                        📸 Lihat Bukti Transfer
                    </button>

                    <div class="grid grid-cols-2 gap-3">
                        @if($pesananTerpilih->status_pesanan == 'menunggu')
                            <button onclick="openActionModal('batalModal', '{{ route('staff.pesanan.cancel', $pesananTerpilih->id_pesanan) }}')"
                                    class="h-14 bg-rose-50 text-rose-600 rounded-2xl font-bold text-sm hover:bg-rose-100 transition-all">
                                ❌ Batalkan
                            </button>
                            <button onclick="openActionModal('verifyModal', '{{ route('staff.pesanan.verifikasi', $pesananTerpilih->id_pesanan) }}')"
                                    class="h-14 bg-emerald-500 text-white rounded-2xl font-bold text-sm hover:bg-emerald-600 shadow-lg shadow-emerald-100">
                                ✅ Verifikasi
                            </button>
                        @elseif($pesananTerpilih->status_pesanan == 'terverifikasi')
                            <button onclick="openActionModal('prosesModal', '{{ route('staff.pesanan.proses', $pesananTerpilih->id_pesanan) }}')"
                                    class="col-span-2 h-14 bg-blue-500 text-white rounded-2xl font-bold text-sm hover:bg-blue-600 shadow-lg">
                                👨‍🍳 Mulai Proses Masak
                            </button>
                        @elseif($pesananTerpilih->status_pesanan == 'diproses')
                            <button onclick="openActionModal('selesaiModal', '{{ route('staff.pesanan.selesai', $pesananTerpilih->id_pesanan) }}')"
                                    class="col-span-2 h-14 bg-orange-600 text-white rounded-2xl font-bold text-sm hover:bg-orange-700 shadow-lg">
                                🏁 Pesanan Siap Diambil
                            </button>
                        @else
                            <div class="col-span-2 p-4 bg-slate-50 rounded-2xl text-center border border-dashed">
                                <p class="text-xs text-slate-400 font-bold italic tracking-wide">PESANAN INI SUDAH FINAL ({{ strtoupper($pesananTerpilih->status_pesanan) }})</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-3xl border border-dashed border-slate-200 h-[750px] flex flex-col items-center justify-center p-20 text-center">
                <div class="w-32 h-32 bg-orange-50 rounded-full flex items-center justify-center mb-6 animate-bounce">
                    <span class="text-5xl">📦</span>
                </div>
                <h3 class="text-xl font-bold text-slate-400">Pilih Pesanan</h3>
                <p class="text-slate-300 text-sm mt-2">Klik salah satu daftar di samping untuk melihat detail dan memproses pesanan.</p>
            </div>
        @endif
    </div>
</div>

<div id="paymentModal" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="relative bg-white rounded-3xl max-w-lg w-full p-2 overflow-hidden shadow-2xl">
        <button onclick="toggleModal('paymentModal')" class="absolute top-4 right-4 bg-white/80 w-10 h-10 rounded-full font-bold shadow-lg text-rose-600">✕</button>
        <div class="p-4">
            <h3 class="font-bold text-center text-slate-700 mb-4">Bukti Pembayaran</h3>
            <img id="modalImage" src="" class="w-full rounded-2xl h-auto max-h-[70vh] object-contain bg-slate-50">
        </div>
    </div>
</div>

@php
    $modals = [
        'verifyModal' => ['icon' => '❓', 'bg' => 'bg-emerald-100', 'btn' => 'bg-emerald-500', 'title' => 'Verifikasi Pembayaran?', 'desc' => 'Pastikan uang sudah masuk ke rekening toko.'],
        'prosesModal' => ['icon' => '👨‍🍳', 'bg' => 'bg-blue-100', 'btn' => 'bg-blue-500', 'title' => 'Mulai Masak?', 'desc' => 'Status akan berubah menjadi Sedang Diproses.'],
        'selesaiModal' => ['icon' => '🏁', 'bg' => 'bg-orange-100', 'btn' => 'bg-orange-600', 'title' => 'Pesanan Selesai?', 'desc' => 'Pelanggan akan diminta untuk mengambil pesanan.'],
        'batalModal' => ['icon' => '⚠️', 'bg' => 'bg-rose-100', 'btn' => 'bg-rose-600', 'title' => 'Batalkan Pesanan?', 'desc' => 'Tindakan ini permanen dan tidak bisa diulang.'],
    ];
@endphp

@foreach($modals as $id => $m)
<div id="{{ $id }}" class="fixed inset-0 z-[110] hidden bg-slate-900/60 flex items-center justify-center p-4 backdrop-blur-[2px]">
    <div class="bg-white rounded-[32px] max-w-sm w-full p-8 shadow-2xl">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full {{ $m['bg'] }} mb-6 text-4xl shadow-inner">{{ $m['icon'] }}</div>
            <h3 class="text-xl font-black text-slate-800 mb-2">{{ $m['title'] }}</h3>
            <p class="text-slate-500 text-sm mb-8 px-4">{{ $m['desc'] }}</p>
            
            <div class="flex flex-col gap-3">
                <form id="{{ $id }}Form" action="" method="POST">
                    @csrf @method('PUT')
                    <button type="submit" class="w-full py-4 {{ $m['btn'] }} text-white rounded-2xl font-bold shadow-lg transition-transform active:scale-95">Ya, Lanjutkan</button>
                </form>
                <button onclick="toggleModal('{{ $id }}')" class="w-full py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold">Kembali</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function toggleModal(id, imgSrc = null) {
        const modal = document.getElementById(id);
        if (imgSrc) {
            document.getElementById('modalImage').src = imgSrc;
        }
        
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }
    function openActionModal(id, url) {
        const form = document.getElementById(id + 'Form');
        form.action = url;
        toggleModal(id);
    }
    window.onclick = function(event) {
        if (event.target.classList.contains('fixed')) {
            event.target.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #CBD5E1; }
</style>
@endsection