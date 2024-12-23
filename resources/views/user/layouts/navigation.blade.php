<nav x-data="{ open: false }" class="bg-gradient-to-r from-teal-600 to-indigo-600 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ asset('build/assets/blogger.png') }}" alt="Logo" class="w-10 h-10 rounded-full shadow-lg">
                </a>
            </div>

            <!-- Search Bar (Centered) -->
            <div class="flex-1 mx-4">
                <div class="relative max-w-xl mx-auto">
                    <input type="text" placeholder="Search..." class="w-full px-4 py-2 text-gray-900 rounded-full border-2 border-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 right-2 transform -translate-y-1/2 w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M11 4a7 7 0 11-7 7 7 7 0 017-7zm0 0a7 7 0 100 14 7 7 0 000-14zm0 0l7 7" />
                    </svg>
                </div>
            </div>

            <!-- Desktop Menu (Profile & Login) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                @auth
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center hover:text-gray-300">
                            <!-- Profile Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.337 0-10 1.672-10 5v2h20v-2c0-3.328-6.663-5-10-5z" />
                            </svg>
                        </button>
                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-800 hover:bg-indigo-900 rounded-lg shadow transition">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = !open" class="text-white p-2 hover:bg-indigo-800 rounded-md focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="bg-gradient-to-r from-teal-600 to-indigo-600 text-white">
            @auth
                <div class="px-4 py-2 border-b border-indigo-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.337 0-10 1.672-10 5v2h20v-2c0-3.328-6.663-5-10-5z" />
                    </svg>
                    <div>
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-300">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-indigo-800">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-indigo-800">Log Out</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-indigo-800">Login</a>
            @endauth
        </div>
    </div>
</nav>
