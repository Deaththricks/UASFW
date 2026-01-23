<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'za Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mainWrapper min-h-screen w-full">
        <!-- HEADER DI SINI -->
        <div class="header h-16 fixed flex items-center top-0 left-0 w-full bg-white z-50 px-32  drop-shadow-lg">
            <!-- LOGO DAN NAMA -->
            <div class="identity flex items-center flex-row w-1/4">
                <div class="logo">
                    <p>Ini Logo</p>
                </div>
                <div class="title">
                    <p class="text-2xl">L'ZA BAKERY</p>
                 </div>
            </div>
            <!-- NAVIGATION -->
            <div class="nav flex items-center justify-around flex-row w-1/2 ">
                <div class="beranda"><a href="{{ url('customer/dashboard') }}" class="hover:text-lisa-yell transition-colors duration-300 ">Beranda</a></div>
                <div class="katalog"><a href="#" class="hover:text-lisa-yell transition-colors duration-300 text-lisa-yell">Katalog</a></div>
                <!-- <div class="riwayat"><a href="#" class="hover:text-lisa-yell transition-colors duration-300">Riwayat</a></div> -->
            </div>
            <!-- SEARCH DAN LOGIN -->
            <div class="searchAndOthers flex items-center flex-1 justify-around">
                <!-- SEARCH -->
                <div class="search bg-search h-8 rounded-xl w-[220px] flex items-center justify-center ">
                    <form action="#">
                    <input type="text" class="focus:outline-none"  placeholder="Cari Produk...">
                    <button type="submite">🔍</button>
                </form>
                </div>
                <!-- LOG IN DAN REGISTRAR -->
                <div class="LogIn flex items-center justify-around">
                    <div class="logIn">
                        <a href="" class="hover:text-lisa-yell transition-colors duration-300">Log In</a>
                    </div>
                    <div class="signIn pl-4">
                        <a href="" class="hover:text-lisa-yell transition-colors duration-300">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- BODY -->
        <div class="contentBody w-full pt-32 px-32 h-screen bg-[url(images/BG1.jpg)] bg-cover bg-center"> 
            <!-- WELCOME GREET -->
                <div class="catalouge h-screen h-1/2 w-full">
                    <div class="title">
                        <p class="text-4xl">🛍️ Produk Terpopuler</p>
                    </div>
                    <div class="popularProduct flex flex-row justify-center items-center pt-12 gap-8 ">
                        @foreach ( $products as $product )
                        <div class="itemCard h-90 w-80 drop-shadow-lg bg-white rounded-xl">
                            <div class="productPhoto w-full h-1/2 bg-[url(/images/BG1.jpg)] bg-cover bg-center"></div>
                            <div class="productInfo w-full h-1/2 flex-col items-center justify-center px-4 ">
                                <div class="pName">
                                    <p class="text-lg font-semibold">{{ $product->nama_produk }}</p>
                                </div>
                                <div class="pDesc py-2">
                                        <p>{{ $product->deskripsi_produk }}</p>
                                </div>
                                <div class="priceAndBuy flex items-center justify-between py-2">
                                    <div class="Price">
                                        <p class="font-semibold"> Rp.{{ number_format($product->harga, 0, ',', '.')}}</p>
                                    </div>
                                    <div class="Order bg-">
                                        <p>🛒 Pesan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
    </div>
</body>