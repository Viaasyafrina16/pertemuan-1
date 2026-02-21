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
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center justify-center min-h-screen p-6">
        
        <div class="w-full max-w-md transition-opacity opacity-100 duration-750">
            <main class="bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] border border-[#19140035] dark:border-[#3E3E3A] rounded-xl overflow-hidden">
                
                <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#fdfdfc] dark:bg-[#1b1b18]">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A]">
                        Kartu Identitas Mahasiswa
                    </h2>
                </div>

                <div class="p-8">
                    <div class="space-y-4">
                        <div>
                            <label class="text-[11px] uppercase tracking-widest text-[#706f6c] dark:text-[#A1A09A] font-bold">Nama Lengkap</label>
                            <p class="text-xl font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Syafrina Metavianida</p>
                        </div>
                        
                        <div class="pt-4 border-t border-[#f4f4f4] dark:border-[#262624]">
                            <label class="text-[11px] uppercase tracking-widest text-[#706f6c] dark:text-[#A1A09A] font-bold">Nomor Induk Mahasiswa</label>
                            <p class="text-2xl font-mono tracking-tight text-[#f53003] dark:text-[#FF4433]">20230140211</p>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-4 bg-[#f9f9f8] dark:bg-[#1b1b18] text-center">
                    <p class="text-[12px] text-[#706f6c] dark:text-[#A1A09A]">
                        Tugas Modifikasi Template Laravel
                    </p>
                </div>
            </main>

            <div class="mt-6 text-center">
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] dark:hover:text-white transition-colors underline underline-offset-4">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

    </body>
</html>