<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Archive') }}</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-700 text-white flex flex-col shadow-xl z-20">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-indigo-600 font-bold text-xl tracking-wider">
            🗄️ E-Archive
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('drive.index') }}" class="flex items-center space-x-3 bg-indigo-800 text-white px-4 py-3 rounded-xl shadow-inner font-medium">
                <span>📁</span>
                <span>My Drive</span>
            </a>
            <a href="#" class="flex items-center space-x-3 text-indigo-200 hover:bg-indigo-600 hover:text-white px-4 py-3 rounded-xl transition font-medium">
                <span>⭐</span>
                <span>Starred (Coming Soon)</span>
            </a>
        </nav>

        <!-- User Profile Area at Bottom -->
        <div class="p-4 border-t border-indigo-600">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-xl shadow-md">
                    👤
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-indigo-300 hover:text-white transition">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden relative">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-8 shadow-sm z-10">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ $header ?? 'Dashboard' }}
            </h2>
            
            <!-- Global Search Placeholder -->
            <div class="w-64">
                <input type="text" placeholder="Search files..." class="w-full text-sm border-gray-300 rounded-full focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 px-4 py-2">
            </div>
        </header>

        <!-- Scrollable Content -->
        <main class="flex-1 overflow-y-auto p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>