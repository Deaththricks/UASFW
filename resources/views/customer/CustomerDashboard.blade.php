<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <div class="LogIn flex items-center justify-around w-1/4">
                <div class="cart relative">
                    <a href="{{ route('cart.index') }}" class="text-xl">🛒</a>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </div>
                <div class="logIn">
                    <a href="{{ route('login') }}" class="hover:text-yellow-500 transition-colors duration-100">Log In</a>
                </div>
                <div class="signIn pl-4">
                    <a href="{{ route('register') }}" class="hover:text-yellow-500 transition-colors duration-100">Sign In</a>
                </div>
            </div>
        </div>

        <div class="contentBody w-full pt-32 px-8 lg:px-32 min-h-screen bg-[url('/images/BG1.jpg')] bg-cover bg-center bg-fixed">
            
            @if(session('success'))
                <div id="success-alert" class="max-w-6xl mx-auto mb-6 flex items-center bg-white/90 backdrop-blur border-l-4 border-green-500 p-4 shadow-lg rounded-r-lg">
                    <div class="flex-shrink-0 text-green-500 text-xl">✅</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-gray-400 hover:text-black font-bold text-lg">&times;</button>
                </div>
            @endif

            <div class="welcomeCard flex items-center w-full justify-center mb-12">
                <div class="explore bg-white/40 backdrop-blur-md p-8 rounded-2xl border border-white/30 shadow-sm text-center">
                    <p class="text-4xl font-bold text-gray-800 uppercase tracking-wide">Selamat Datang di L'ZA BAKERY</p>
                    <p class="mt-2 text-gray-700 max-w-2xl mx-auto">
                        Nikmati berbagai kue dan pastry premium yang dibuat dengan cinta dan bahan berkualitas tinggi.
                    </p>
                </div>
            </div>

            <div class="catalogue w-full">
                <div class="category-filter pt-10">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Katalog Produk</h2>
                    
                    @if(request('search'))
                        <p class="mb-4 text-gray-600 italic">Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
                    @endif

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('main.dashboard', ['category' => 'all', 'search' => request('search')]) }}" 
                           class="px-6 py-2 rounded-full border transition-all {{ request('category') == 'all' || !request('category') ? 'bg-yellow-500 text-white border-yellow-500 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                            Semua
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('main.dashboard', ['category' => $cat->id_kategori, 'search' => request('search')]) }}" 
                               class="px-6 py-2 rounded-full border transition-all {{ request('category') == $cat->id_kategori ? 'bg-yellow-500 text-white border-yellow-500 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                                {{ $cat->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="Katalog flex flex-row justify-center items-center pt-12">
                    @if($products->isEmpty())
                        <div class="bg-white/70 backdrop-blur p-12 rounded-xl text-center w-full">
                            <p class="text-xl text-gray-500 italic">Maaf, produk tidak ditemukan.</p>
                            <a href="{{ route('main.dashboard') }}" class="text-yellow-600 font-bold hover:underline">Reset pencarian</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 w-full">
                            @foreach ($products as $product)
                            <div class="itemCard group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col h-[450px]">
                                <a href="{{ route('ProductShow', $product->id_produk) }}" class="h-full flex flex-col">
                                    <div class="productPhoto w-full h-1/2 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                        style="background-image: url('{{ asset("storage/" . $product->gambar_produk) }}');">
                                    </div>

                                    <div class="productInfo w-full flex flex-col flex-1 p-5">
                                        <div class="pName">
                                            <p class="text-xl font-bold text-gray-800">{{ $product->nama_produk }}</p>
                                        </div>

                                        <div class="pDesc py-3 flex-1">
                                            <p class="text-sm text-gray-600 line-clamp-3">{{ $product->deskripsi_produk }}</p>
                                        </div>

                                        <div class="priceAndBuy flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                            <div class="Price">
                                                <p class="font-bold text-xl text-gray-900">
                                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div class="Order bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-yellow-600 transition-colors">
                                                🛒 Pesan
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="pagination pt-12 pb-12 flex justify-center">
                    {{ $products->links() }}
                </div>
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