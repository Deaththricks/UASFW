<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                text: '{{ $errors->first() }}'
            }); 
        </script>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
            class="w-full border p-2 rounded mb-3" required>

        <input type="text" name="user_name" placeholder="Username"
            class="w-full border p-2 rounded mb-3" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 rounded mb-3" required>

        <input type="text" name="no_hp" placeholder="No. HP"
            class="w-full border p-2 rounded mb-3" required>

        <textarea name="alamat" placeholder="Alamat Lengkap"
            class="w-full border p-2 rounded mb-3" rows="3" required></textarea>

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 rounded mb-3" required>

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
            class="w-full border p-2 rounded mb-4" required>

        <button class="w-full bg-[#e8b44a] text-white py-2 rounded hover:bg-[#d9a73f]">
            Daftar
        </button>
    </form>

    <p class="text-sm mt-4 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-[#e8b44a]">Login</a>
    </p>
    <p class="text-sm mt-4 text-center" > Kembali ke <a href="{{ route('main.dashboard') }}" class="text-[#e8b44a]">dashboard</a></p>
</div>

</body>
</html>
