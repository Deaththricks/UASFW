<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Manager Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-gray-200 min-h-screen flex flex-col">
        <div class="p-6 flex-1">

            <h1 class="text-2xl font-bold mb-10 text-white">
                Manager Panel
            </h1>

            <ul class="space-y-2">

                <!-- Dashboard -->
                <li>
                    <a href="{{ url('manager/dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
                    {{ request()->is('manager/dashboard') 
                            ? 'bg-[#e8b44a] text-gray-900 font-semibold' 
                            : 'hover:bg-gray-800' }}">
                        📊 Dashboard
                    </a>
                </li>

                <!-- Users -->
                <li>
                    <a href="{{ url('manager/users') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
                    {{ request()->is('manager/users*') 
                            ? 'bg-[#e8b44a] text-gray-900 font-semibold' 
                            : 'hover:bg-gray-800' }}">
                        👤 Kelola User
                    </a>
                </li>

                <!-- Produk -->
                <li>
                    <a href="{{ url('manager/produk') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
                    {{ request()->is('manager/produk*') 
                            ? 'bg-[#e8b44a] text-gray-900 font-semibold' 
                            : 'hover:bg-gray-800' }}">
                        📦 Kelola Produk
                    </a>
                </li>

                <!-- Kategori -->
                <li>
                    <a href="{{ route('manager.kategori.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
                    {{ request()->is('manager/kategori*') 
                            ? 'bg-[#e8b44a] text-gray-900 font-semibold' 
                            : 'hover:bg-gray-800' }}">
                        🗂️ Kelola Kategori
                    </a>
                </li>

                <!-- Laporan -->
                <li>
                    <a href="{{ url('manager/laporan') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
                    {{ request()->is('manager/laporan*') 
                            ? 'bg-[#e8b44a] text-gray-900 font-semibold' 
                            : 'hover:bg-gray-800' }}">
                        📈 Laporan Penjualan
                    </a>
                </li>

                <hr class="border-gray-700 my-6">

                <!-- Logout -->
                <li>
                    <button onclick="confirmLogout()"
                            class="w-full flex items-center gap-3 px-4 py-2 rounded-lg
                                text-red-400 hover:bg-red-600/20">
                        🚪 Logout
                    </button>
                </li>

            </ul>
        </div>

        <div class="p-4 text-sm border-t border-gray-700 text-gray-400">
            Login sebagai:<br>
            <span class="font-semibold text-white">
                {{ auth()->user()->nama_lengkap ?? '-' }}
            </span>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                })
            </script>
        @endif

        @yield('content')
        @yield('scripts')
    </main>

    <!-- Logout Confirmation -->
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Sesi akan diakhiri',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

</body>
</html>
