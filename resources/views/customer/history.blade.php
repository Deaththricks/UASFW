<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery - Dashboard</title>
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
                <div class="div">
                    <a href="{{ route('main.dashboard') }}" class="hover:text-yellow-500 transition-colors duration-100">Return to dashboard</a>
                </div>
                <div class="cart relative">
                    <a href="{{ route('cart.index') }}" class="text-xl">🛒</a>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </div>

               
                @guest
                   
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

                            <form method="POST" action="{{ route('logout') }}">
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
        <div class="contentBody w-full pt-32 px-8 lg:px-32 min-h-screen  bg-cover bg-center bg-fixed">
            @if(session('success'))
                <div id="success-alert" class="max-w-6xl mx-auto mb-6 flex items-center bg-white/90 backdrop-blur border-l-4 border-green-500 p-4 shadow-lg rounded-r-lg">
                    <div class="flex-shrink-0 text-green-500 text-xl">✅</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-gray-400 hover:text-black font-bold text-lg">&times;</button>
                </div>
            @endif

            <div class="welcomeCard flex items-center w-full justify-center mb-12 flex flex-col gap-3 ">
                <div class="explore bg-white/40 backdrop-blur-md p-8 rounded-2xl border border-white/30 shadow-sm text-center  w-3/10">
                    <p class="text-4xl font-bold text-gray-800 uppercase tracking-wide">L'ZA BAKERY</p>
                    <p class="mt-2 text-gray-700 max-w-2xl mx-auto">Riwayat Pemesanan</p>
                </div>
                @foreach ($orders as $order)
                    <div class="historyItemCard explore bg-white/40 backdrop-blur-md p-8 rounded-2xl border border-white/30 shadow-sm text-center w-3/10 h-fit ">
                    <div class="idAndStatus flex justify-between py-2 ">
                        <div class="idAndDate">
                            <div class="id">
                                <p>Order id: {{ $order->id_pesanan }}</p>
                            </div>
                            <div class="tanggal flex justify-start">
                                <p class="text-stone-600">{{ $order->tanggal_pesanan }}</p>
                            </div>
                        </div>
                        <div class="status ">
                            <p>{{ $order->status_pesanan }}</p>
                        </div>
                    </div>
                    <div class="div  py-2 border-t-1 border-b-1 border-stone-200">
                        <div class="pesananLabel flex justify-start">
                            <p>Item Pesanan</p>
                        </div>
                        @foreach($order->details as $item)
                        <div class="order  flex justify-start">
                            <p>- {{ $item->produk->nama_produk ?? 'Produk tidak ditemukan' }} </p><br>
                            <p>{{ $item->jumlah }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="total flex justify-between py-2">
                        <div class="totalPemText">
                            <p>Total Pembayaran</p>
                        </div>
                        <div class="TotalPemAmm">
                            <p>Rp {{ number_format($order->total_pembayaran, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>

    @if(session('success_order'))
    <div id="order-modal" class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl p-8 max-w-sm w-full text-center shadow-2xl">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">✓</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Order Terkirim!</h2>
            <p class="text-gray-600 mb-6 text-sm leading-relaxed">{{ session('success_order') }}</p>
            <button onclick="document.getElementById('order-modal').remove()" 
                    class="w-full bg-yellow-500 text-white font-bold py-3 rounded-xl hover:bg-yellow-600 transition-all shadow-lg shadow-yellow-200">
                Tutup
            </button>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.6s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 600);
                }, 4000);
            }
        });
    </script>
</body>
</html>