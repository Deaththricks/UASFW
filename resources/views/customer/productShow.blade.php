<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery - {{ $product->nama_produk }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="mainWrapper min-h-screen w-full">
        <div class="header h-16 fixed flex items-center justify-center top-0 left-0 w-full bg-white z-50 px-8 drop-shadow-lg">
            <div class="identity flex items-center flex-row w-1/8">
                <a href="{{ route('main.dashboard') }}"><p class="text-2xl font-bold">L'ZA BAKERY</p></a>
            </div>
            <div class="searchAndOthers flex items-center flex-1 justify-between px-10">
                <div class="search bg-gray-100 h-8 rounded-xl flex items-center flex-1 px-4">
                    <input type="text" class="bg-transparent focus:outline-none w-full text-sm" placeholder="Cari Produk...">
                    <span>🔍</span>
                </div>
            </div>
            <div class="LogIn flex items-center justify-around w-1/4">
                <a href="{{ route('cart.index') }}" class="text-xl">🛒</a>
                <a href="{{ route('login') }}">Log In</a>
                <a href="{{ route('register') }}">Sign In</a>
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