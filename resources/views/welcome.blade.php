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
        <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen p-6 flex flex-col items-center">

    <nav class="w-full max-w-4xl flex justify-end mb-12">
        <div class="flex items-center">
            @guest
                <a href="{{ route('login') }}" 
                   class="text-sm font-medium text-gray-600 hover:text-black transition-colors me-4 inline-block">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="text-sm font-medium text-gray-600 hover:text-black transition-colors inline-block">
                        Register
                    </a>
                @endif
            @endguest

            @auth
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 me-4">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-sm text-red-600 hover:text-red-800 font-medium transition-colors">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>


    <div class="w-full max-w-md">
        <main class="bg-white dark:bg-[#161615] shadow-xl border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden">
            
            <div class="p-6 border-b bg-gray-50/50 dark:bg-[#1b1b18]">
                <h2 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                    Kartu Identitas Mahasiswa
                </h2>
            </div>

            <div class="p-8">
                <div class="space-y-6">
                    <div>
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                            Nama Lengkap
                        </label>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mt-1">
                            Syafrina Metavianida
                        </p>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-50 dark:border-gray-800">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                            Nomor Induk Mahasiswa
                        </label>
                        <p class="text-3xl font-mono tracking-tighter text-red-600 dark:text-red-500 mt-1">
                            20230140211
                        </p>
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50/80 dark:bg-[#1b1b18]/50 border-t border-gray-50 dark:border-gray-800 text-center">
                <p class="text-[11px] font-medium text-gray-400">
                    Tugas Modifikasi Template Laravel &bull; Syafrina Metavianida
                </p>
            </div>
        </main>

        <div class="mt-8 text-center">
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-black dark:hover:text-white transition-colors flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>