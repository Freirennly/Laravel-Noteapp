<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 relative">

    {{-- Navbar --}}
    <nav class="bg-indigo-600 shadow relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Logo --}}
                <a href="{{ route('notes.index') }}" class="text-white font-bold text-xl">
                    Catatan
                </a>

                {{-- Desktop & Tablet Menu --}}
                <div class="hidden md:flex space-x-4">
                    {{-- Notes --}}
                    <a href="{{ route('notes.index') }}" 
                        class="flex items-center px-3 py-2 rounded 
                        {{ request()->routeIs('notes.index') ? 'bg-indigo-800 text-white' : 'text-white hover:text-gray-200' }}">
                        Notes
                    </a>

                    {{-- Kategori --}}
                    <a href="{{ route('categories.index') }}" 
                        class="flex items-center px-3 py-2 rounded 
                        {{ request()->routeIs('categories.*') ? 'bg-indigo-800 text-white' : 'text-white hover:text-gray-200' }}">
                        Kategori
                    </a>
                </div>

                {{-- Hamburger for mobile --}}
                <div class="md:hidden z-30">
                    <button id="hamburger-btn" class="relative w-8 h-8 flex flex-col justify-center items-center focus:outline-none">
                        <span class="block absolute w-8 h-0.5 bg-white rounded transform transition duration-300 ease-in-out" id="line1"></span>
                        <span class="block absolute w-8 h-0.5 bg-white rounded transform transition duration-300 ease-in-out" id="line2"></span>
                        <span class="block absolute w-8 h-0.5 bg-white rounded transform transition duration-300 ease-in-out" id="line3"></span>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    {{-- Mobile Overlay --}}
    <div id="overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-10 md:hidden"></div>

    {{-- Mobile Sidebar --}}
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-indigo-700 transform -translate-x-full transition-transform duration-300 z-20 flex flex-col py-10 md:hidden">
        <a href="{{ route('notes.index') }}" 
            class="text-white text-xl px-6 py-2 rounded block
            {{ request()->routeIs('notes.index') ? 'bg-indigo-600' : 'hover:bg-indigo-600' }}">
            Notes
        </a>

        <a href="{{ route('categories.index') }}" 
            class="text-white text-xl px-6 py-2 rounded block
            {{ request()->routeIs('categories.*') ? 'bg-indigo-600' : 'hover:bg-indigo-600' }}">
            Kategori
        </a>
    </aside>

    {{-- Konten --}}
    <main class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-0">
        @yield('content')
    </main>

</body>
</html>
