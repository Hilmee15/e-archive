<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Archive') }}</title>

    <!-- Load Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Vibrant Animated Background -->
    <div class="relative min-h-screen flex flex-col justify-center overflow-hidden bg-gray-50">
        
        <!-- Decorative Background Blobs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

        <!-- Top Navigation -->
        @if (Route::has('login'))
            <div class="absolute top-0 right-0 w-full p-6 flex justify-end z-20">
                @auth
                    <a href="{{ route('drive.index') }}" class="text-sm font-bold text-indigo-900 hover:text-indigo-600 px-4 py-2 rounded-full hover:bg-white/50 transition backdrop-blur-sm">
                        My Drive &rarr;
                    </a>
                @else
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-full hover:bg-white/50 transition backdrop-blur-sm">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-5 py-2.5 rounded-full shadow-md transition transform hover:-translate-y-0.5">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        @endif

        <!-- Main Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8 flex flex-col items-center text-center">
            
            <!-- Glassmorphism Icon Container -->
            <div class="mb-8 p-4 bg-white/30 backdrop-blur-lg rounded-3xl shadow-xl border border-white/40 inline-block transform -rotate-3 hover:rotate-0 transition duration-300">
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 w-24 h-24 rounded-2xl flex items-center justify-center shadow-inner">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012-2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>

            <!-- Gradient Text Heading -->
            <h1 class="text-6xl md:text-7xl font-extrabold tracking-tight mb-6">
                <span class="text-gray-900 block">Your Personal</span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
                    E-Archive Studio
                </span>
            </h1>
            
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto font-medium leading-relaxed mb-10">
                A beautiful, lightning-fast local file manager. Organize your documents with infinite nested folders and keep your data completely private.
            </p>

            <!-- Dynamic CTA Button -->
            <div class="flex justify-center gap-4">
                @auth
                    <a href="{{ route('drive.index') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-gray-800 hover:-translate-y-1 shadow-xl hover:shadow-2xl">
                        Open My Drive
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gradient-to-r from-indigo-600 to-purple-600 font-pj rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:-translate-y-1 shadow-xl hover:shadow-2xl hover:from-indigo-500 hover:to-purple-500">
                        Get Started
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-full hover:bg-gray-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-sm hover:-translate-y-1">
                        Log in
                    </a>
                @endauth
            </div>

            <!-- Features Quick Look -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20 text-left">
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-white/60 shadow-sm">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-4 text-xl">📁</div>
                    <h3 class="font-bold text-gray-900 mb-2">Nested Folders</h3>
                    <p class="text-gray-600 text-sm">Organize exactly like Google Drive with infinite directory structures.</p>
                </div>
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-white/60 shadow-sm">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 mb-4 text-xl">🔒</div>
                    <h3 class="font-bold text-gray-900 mb-2">Locally Secure</h3>
                    <p class="text-gray-600 text-sm">Files bypass the public internet and stay strictly on your local disk.</p>
                </div>
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-white/60 shadow-sm">
                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center text-pink-600 mb-4 text-xl">⚡</div>
                    <h3 class="font-bold text-gray-900 mb-2">Lightning Fast</h3>
                    <p class="text-gray-600 text-sm">Powered by Laravel & Tailwind CSS for an instant, reactive UI.</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>