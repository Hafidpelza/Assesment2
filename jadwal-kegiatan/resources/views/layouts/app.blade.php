<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jadwal Kegiatan') - Hidup Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-white text-gray-800">
    <header class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
        <a href="{{ route('kegiatan.index') }}" class="font-bold text-green-700">🌿 HIDUP SEHAT</a>
        <nav class="hidden md:flex gap-6 text-xs text-gray-600">
            <a href="{{ route('kegiatan.index') }}"
               class="{{ request()->routeIs('kegiatan.*') ? 'text-green-700 font-semibold' : 'hover:text-green-700' }}">
                Schedule
            </a>
            <a href="{{ route('exercise.index') }}"
               class="{{ request()->routeIs('exercise.*') ? 'text-green-700 font-semibold' : 'hover:text-green-700' }}">
                Exercise
            </a>
            <a href="{{ route('asupan-makanan.index') }}"
               class="{{ request()->routeIs('asupan-makanan.*') ? 'text-green-700 font-semibold' : 'hover:text-green-700' }}">
                Asupan Makanan
            </a>
        </nav>
        <div class="w-9 h-9 rounded-full bg-gray-300"></div>
    </header>

    <main class="max-w-6xl mx-auto px-6 pb-12">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="max-w-6xl mx-auto px-6 py-6 text-xs text-gray-500 flex justify-between">
        <span class="font-semibold">HIDUP SEHAT</span>
        <span>© 2026 HIDUP SEHAT. All rights reserved.</span>
    </footer>
</body>
</html>