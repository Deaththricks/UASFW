<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'ZA BAKERY - Staff Panel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #F8F4F0; 
        }
    </style>
</head>
<body class="antialiased text-slate-800">

    <header class="bg-[#FFFDFB] border-b border-orange-100 sticky top-0 z-50">
        <div class="max-w-[1400px] mx-auto px-6 h-20 flex items-center justify-between">
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-xl">
                    🍞
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight text-[#5C3D2E]">L'ZA BAKERY</h1>
                    <p class="text-xs text-slate-400 font-medium">Staff Panel</p>
                </div>
            </div>

            <form action="{{ route('staff.dashboard.index') }}" method="GET" class="hidden md:flex items-center bg-[#F3EFEA] rounded-xl px-4 py-2 w-full max-w-md mx-8">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                
                <span class="text-slate-400 mr-2">🔍</span>
                
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari Nama Pelanggan..." 
                    class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none">
                
                @if(request('search'))
                    <a href="{{ route('staff.dashboard.index', ['status' => request('status')]) }}" class="text-slate-400 hover:text-rose-500 ml-2 text-xs whitespace-nowrap">
                        ✕ Clear
                    </a>
                @endif
            </form>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">
                        {{ Auth::user()->nama_lengkap ?? 'Staff Name' }}
                    </p>
                    <p class="text-[10px] text-orange-600 font-bold tracking-widest uppercase">
                        Staff Active
                    </p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap ?? 'Staff') }}&background=5C3D2E&color=fff" 
                    alt="Avatar" 
                    class="w-10 h-10 rounded-full border-2 border-orange-100">
            </div>

        </div>
    </header>

    <main class="max-w-[1400px] mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>