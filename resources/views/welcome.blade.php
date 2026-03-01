<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Identitas Mahasiswa - Laravel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style>
            :root {
                --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            }
            body {
                font-family: var(--font-sans);
            }
        </style>
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center justify-center min-h-screen p-6 relative">

    <!-- 🔥 LOGIN LOGOUT MENU -->
    <div class="absolute top-6 right-6">
        @guest
            <a href="{{ route('login') }}" 
               class="text-sm font-medium text-gray-600 hover:text-black mr-4">
                Login
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" 
                   class="text-sm font-medium text-gray-600 hover:text-black">
                    Register
                </a>
            @endif
        @endguest

        @auth
            <span class="text-sm mr-4">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        class="text-sm text-red-600 hover:text-red-800">
                    Logout
                </button>
            </form>
        @endauth
    </div>


    <!-- CARD -->
    <div class="w-full max-w-md transition-opacity opacity-100 duration-750">
        <main class="bg-white dark:bg-[#161615] shadow-md border rounded-xl overflow-hidden">
            
            <div class="p-6 border-b bg-[#fdfdfc] dark:bg-[#1b1b18]">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Kartu Identitas Mahasiswa
                </h2>
            </div>

            <div class="p-8">
                <div class="space-y-4">
                    <div>
                        <label class="text-[11px] uppercase tracking-widest text-gray-500 font-bold">
                            Nama Lengkap
                        </label>
                        <p class="text-xl font-medium">
                            Syafrina Metavianida
                        </p>
                    </div>
                    
                    <div class="pt-4 border-t">
                        <label class="text-[11px] uppercase tracking-widest text-gray-500 font-bold">
                            Nomor Induk Mahasiswa
                        </label>
                        <p class="text-2xl font-mono tracking-tight text-red-600">
                            20230140211
                        </p>
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50 text-center">
                <p class="text-[12px] text-gray-500">
                    Tugas Modifikasi Template Laravel
                </p>
            </div>
        </main>

        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-600 hover:text-black underline">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>