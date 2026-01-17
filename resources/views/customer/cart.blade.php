<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery - Checkout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">
    <div class="header h-16 fixed flex items-center justify-between top-0 left-0 w-full bg-white z-50 px-8 shadow-sm">
        <div class="identity"><a href="{{ route('main.dashboard') }}"><p class="text-2xl font-bold italic text-gray-800 text-yellow-600">L'ZA BAKERY</p></a></div>
        <div class="links flex gap-6 font-semibold text-gray-600">
            <a href="{{ route('main.dashboard') }}" class="hover:text-yellow-600">Katalog</a>
            <a href="{{ route('cart.index') }}" class="text-yellow-600 border-b-2 border-yellow-600">Keranjang</a>
        </div>
    </div>

    @php 
        $total = 0;
        foreach(session('cart', []) as $details) { 
            $total += ($details['price'] ?? 0) * $details['quantity']; 
        }
    @endphp

    <div class="mainContent pt-32 px-8 lg:px-32 min-h-screen pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2 space-y-4">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Review Pesanan</h1>
                @forelse(session('cart', []) as $id => $details)
                    <div class="flex items-center bg-white p-6 rounded-2xl border border-gray-100 justify-between shadow-sm">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-20 h-20 object-cover rounded-xl shadow-sm">
                            <div class="ml-6">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $details['name'] }}</h3>
                                <p class="text-yellow-600 font-bold">Rp {{ number_format($details['price'] ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" onchange="this.form.submit()" class="w-16 border-2 rounded-xl p-2 text-center border-gray-100 focus:border-yellow-500 outline-none transition-all">
                            </form>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2 bg-red-50 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-10 rounded-2xl text-center border border-dashed border-gray-300"><p class="text-gray-400 font-medium">Keranjang Anda masih kosong.</p></div>
                @endforelse
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-50 sticky top-24">
                    
                    <div id="step-pemesan">
                        <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Data Pemesan</h2>
                        <div class="space-y-4">
                            <input type="text" id="nama" placeholder="Nama Lengkap" class="w-full border-2 border-gray-100 p-3 rounded-2xl outline-none focus:border-yellow-500 transition-all">
                            <input type="tel" id="telepon" placeholder="Nomor Telepon" class="w-full border-2 border-gray-100 p-3 rounded-2xl outline-none focus:border-yellow-500 transition-all">
                            <textarea id="alamat" rows="2" placeholder="Alamat Pengiriman" class="w-full border-2 border-gray-100 p-3 rounded-2xl outline-none focus:border-yellow-500 transition-all"></textarea>
                            <input type="date" id="tanggal" class="w-full border-2 border-gray-100 p-3 rounded-2xl outline-none focus:border-yellow-500 transition-all">
                            
                            <div class="pt-4 border-t flex justify-between items-center font-bold">
                                <span class="text-gray-400">Total Tagihan:</span>
                                <span class="text-2xl text-yellow-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <button type="button" onclick="goToPayment()" class="w-full bg-yellow-500 text-white font-bold py-4 rounded-2xl shadow-lg shadow-yellow-100 mt-2 hover:scale-[1.02] active:scale-95 transition-all">Pilih Metode Pembayaran</button>
                        </div>
                    </div>

                    <div id="step-pembayaran" class="hidden">
                        <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Metode Pembayaran</h2>
                        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nama" id="h-nama"> 
                            <input type="hidden" name="tel" id="h-tel">
                            <input type="hidden" name="alamat" id="h-alamat"> 
                            <input type="hidden" name="tgl" id="h-tgl">

                            <div class="space-y-4">
                                <label class="flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all border-gray-100" id="label-cod">
                                    <input type="radio" name="method" value="COD" class="hidden" onchange="toggleDetails('cod')" checked>
                                    <span class="font-bold text-gray-700">COD (Bayar di Tempat)</span>
                                </label>

                                <div class="space-y-2">
                                    <label class="flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all border-gray-100" id="label-transfer">
                                        <input type="radio" name="method" value="Transfer" class="hidden" onchange="toggleDetails('transfer')">
                                        <span class="font-bold text-gray-700">Transfer Bank</span>
                                    </label>
                                    
                                    <div id="details-transfer" class="hidden p-5 bg-yellow-50 border-2 border-yellow-200 rounded-2xl space-y-3">
                                        <p class="text-[10px] font-black text-yellow-700 uppercase tracking-widest">Informasi Rekening Anda</p>
                                        <input type="text" name="bank_user" placeholder="Nama Bank Anda" class="w-full border-2 border-white p-2 rounded-xl text-sm focus:border-yellow-400 outline-none">
                                        <input type="text" name="norek_user" placeholder="Nomor Rekening Anda" class="w-full border-2 border-white p-2 rounded-xl text-sm focus:border-yellow-400 outline-none">
                                        <input type="text" name="nama_user" placeholder="Atas Nama Pengirim" class="w-full border-2 border-white p-2 rounded-xl text-sm focus:border-yellow-400 outline-none">
                                    </div>
                                </div>
                            </div>

                            <div id="upload-section" class="hidden mt-6 bg-gray-50 p-5 rounded-2xl border-dashed border-2 border-gray-200 text-center">
                                <p class="text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-tighter">Lampirkan Bukti Transfer</p>
                                <input type="file" name="bukti" class="text-xs w-full cursor-pointer">
                            </div>

                            <div class="pt-4 mt-6 border-t flex justify-between items-center font-bold">
                                <span class="text-gray-400">Total Bayar:</span>
                                <span class="text-2xl text-yellow-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <button type="submit" class="w-full bg-yellow-500 text-white font-bold py-4 rounded-2xl mt-4 shadow-lg shadow-yellow-100 hover:scale-[1.02] active:scale-95 transition-all">Konfirmasi Pesanan</button>
                            <button type="button" onclick="goToPemesan()" class="w-full mt-4 text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">Ubah Data Diri</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToPayment() {
            if(!document.getElementById('nama').value || !document.getElementById('alamat').value) return alert('Harap isi Nama dan Alamat!');
            document.getElementById('h-nama').value = document.getElementById('nama').value;
            document.getElementById('h-tel').value = document.getElementById('telepon').value;
            document.getElementById('h-alamat').value = document.getElementById('alamat').value;
            document.getElementById('h-tgl').value = document.getElementById('tanggal').value;
            document.getElementById('step-pemesan').classList.add('hidden');
            document.getElementById('step-pembayaran').classList.remove('hidden');
        }
        function goToPemesan() {
            document.getElementById('step-pembayaran').classList.add('hidden');
            document.getElementById('step-pemesan').classList.remove('hidden');
        }
        function toggleDetails(m) {
            ['cod', 'transfer'].forEach(x => {
                const label = document.getElementById(`label-${x}`);
                const detail = document.getElementById(`details-${x}`);
                label.classList.remove('border-yellow-500', 'bg-yellow-50');
                if(detail) detail.classList.add('hidden');
            });
            document.getElementById(`label-${m}`).classList.add('border-yellow-500', 'bg-yellow-50');
            if(document.getElementById(`details-${m}`)) document.getElementById(`details-${m}`).classList.remove('hidden');
            document.getElementById('upload-section').classList.toggle('hidden', m === 'cod');
        }
        toggleDetails('cod');
    </script>
</body>
</html>