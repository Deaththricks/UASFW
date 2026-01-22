<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery - {{ $product->nama_produk }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #F8F4F0; 
        }
        .search, .ngga-ada {
            background-color: #F8F4F0; 
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="mainWrapper min-h-screen w-full">
        <div class="header h-16 fixed flex items-center justify-center top-0 left-0 w-full bg-white z-50 px-8 drop-shadow-lg">
            <div class="identity flex items-center flex-row w-1/8">
                <div class="title">
                    <a href="{{ route('main.dashboard') }}"><p class="text-2xl font-bold">L'ZA BAKERY</p></a>
                </div>
            </div>

            <div class="searchAndOthers flex items-center flex-1 justify-between px-10">
                <div class="search bg-gray-100 h-8 rounded-xl flex items-center flex-1">
                    <div class="search flex items-center flex-row w-full">
                        <form action="{{ route('main.dashboard') }}" method="GET" class="pl-4 flex items-center w-full">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="focus:outline-none w-full bg-transparent text-sm" 
                                placeholder="Cari Produk...">
                            <button type="submit" class="pr-4 flex-1 text-gray-500 hover:text-black">🔍</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="LogIn flex items-center justify-end gap-6 w-1/4">
                <div class="links flex gap-6 font-semibold text-gray-600">
                    <a href="{{ route('main.dashboard') }}" class="hover:text-yellow-600">Kembali ke katalog</a>
                </div>
                <div class="cart relative">
                    <a href="{{ route('cart.index') }}" class="text-xl">🛒</a>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </div>

                {{-- Authentication Switch --}}
                @guest
                    {{-- Shown only when NOT logged in --}}
                    <div class="logIn">
                        <a href="{{ route('login') }}" class="hover:text-yellow-500 transition-colors duration-100 font-semibold text-sm">Log In</a>
                    </div>
                    <div class="signIn pl-4">
                        <a href="{{ route('register') }}" class="hover:text-yellow-500 transition-colors duration-100 font-semibold text-sm">Sign In</a>
                    </div>
                @endguest

                @auth
                    {{-- Shown only when logged in --}}
                    <div class="relative group ml-4">
                        <button class="flex items-center gap-2 focus:outline-none py-2">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-700 font-bold text-xs border border-yellow-200">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="absolute right-0 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl py-2 hidden group-hover:block z-50">
                            <div class="px-4 py-1 mb-1">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Akun Saya</p>
                            </div>
                            
                            <a href="{{ route('customer.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 transition-colors">
                                Riwayat Pesanan
                            </a>

                            <hr class="my-1 border-gray-50">

                            <form method="POST" action="{{ route('logout.customer') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 font-bold hover:bg-red-50 transition-colors">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>

        <div class="contentBody w-full pt-32 px-32 h-screen"> 
            <div class="contentWrapper h-full w-full flex justify-between gap-10">
                <div class="productImage w-2/5">
                    <img src="{{ asset('storage/'. $product->gambar_produk) }}" class="rounded-2xl shadow-lg w-full">
                </div>

                <div class="productInfo w-1/4">
                    <h1 class="text-3xl font-bold mb-2">{{ $product->nama_produk }}</h1>
                    <p class="text-4xl font-bold mb-4">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="text-gray-600">{{ $product->deskripsi_produk }}</p>
                </div>

                <div class="addquantity h-max w-1/4 p-6 rounded-2xl shadow-xl bg-white border border-gray-100">
                    <form action="{{ route('cart.add', $product->id_produk) }}" method="POST">
                        @csrf 
                        <div class="flex flex-col gap-4 items-center">
                            <label class="text-sm font-semibold text-gray-500">Jumlah Pesanan</label>
                            <div class="flex items-center border border-gray-300 rounded-full px-3 py-1">
                                <button type="button" onclick="changeQty(-1)" class="text-2xl px-2 text-gray-400">&minus;</button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" oninput="updatePrice()"
                                    class="w-12 text-center font-bold text-lg focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" onclick="changeQty(1)" class="text-2xl px-2 text-yellow-500">&plus;</button>
                            </div>
                            <div class="w-full text-center py-4 border-y border-gray-50">
                                <p class="text-xs text-gray-400">Total: <span class="hidden" id="unit-price-raw">{{ $product->harga }}</span></p>
                                <p class="text-xl font-bold">Rp. <span id="total-price-display">{{ number_format($product->harga, 0, ',', '.') }}</span></p>
                            </div>
                            <button type="submit" class="w-full border-2 border-black hover:bg-black hover:text-white font-bold py-3 rounded-xl transition-all">
                                Tambahkan ke keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updatePrice() {
            const qty = parseInt(document.getElementById('quantity').value) || 0;
            const price = parseInt(document.getElementById('unit-price-raw').innerText);
            document.getElementById('total-price-display').innerText = (qty * price).toLocaleString('id-ID');
        }
        function changeQty(amt) {
            const input = document.getElementById('quantity');
            let val = (parseInt(input.value) || 1) + amt;
            if (val >= 1) { input.value = val; updatePrice(); }
        }
    </script>
</body>
</html>