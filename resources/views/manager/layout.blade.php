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
    <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col">
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-bold mb-8">Manager Panel</h1>

            <ul class="space-y-4">
                <li>
                    <a href="{{ url('manager/dashboard') }}" class="hover:text-blue-400">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('manager/users') }}" class="hover:text-blue-400">
                        👤 Kelola User
                    </a>
                </li>
                <li>
                    <a href="{{ url('manager/produk') }}" class="hover:text-blue-400">
                        📦 Kelola Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('manager.kategori.index') }}" class="hover:text-blue-400">
                        🗂️ Kelola Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ url('manager/laporan') }}" class="hover:text-blue-400">
                        📈 Laporan Penjualan
                    </a>
                </li>

                <hr class="border-gray-700 my-6">

                <!-- Logout -->
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button"
                            onclick="confirmLogout()"
                            class="w-full text-left text-red-400 hover:text-red-500">
                            🚪 Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Footer Sidebar -->
        <div class="p-4 text-sm text-gray-400 border-t border-gray-700">
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
