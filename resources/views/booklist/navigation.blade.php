<nav x-data="{ open: false, mobileMenu: false }" class="bg-white border-b border-gray-100">
    <!-- Navbar Header -->
    <header class="bg-[#37709F] shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Desktop Navigation -->
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="relative group block">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                            class="h-14 w-auto object-contain transition-all duration-300 transform group-hover:scale-110 rounded-lg shadow-md hover:shadow-lg">
                        <div
                            class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-300">
                        </div>
                    </a>
                </div>
                

                <!-- Desktop Menu -->
                <div class="hidden sm:flex items-center">
                    <div class="flex space-x-8">
                        <a href="{{ route('booklist.index') }}" class="px-3 py-2 text-sm font-bold text-white hover:text-blue-200 transition-colors">Home</a>
                        
                        <!-- Kategori Dropdown -->
                        <div class="relative group">
                            <button class="px-3 py-2 text-sm font-bold text-white hover:text-blue-200 transition-colors">
                                Kategori
                            </button>
                            <div class="hidden group-hover:block absolute z-10 left-0 mt-1 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <a href="{{ route('category.show', 'smp') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">SMP</a>
                                <a href="{{ route('category.show', 'sma') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">SMA/SMK</a>
                                <a href="{{ route('category.show', 'kejuruan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">Kejuruan</a>
                            </div>
                        </div>

                        <!-- BookList Dropdown -->
                        <div class="relative group">
                            <button class="px-3 py-2 text-sm font-bold text-white hover:text-blue-200 transition-colors">
                                BookList
                            </button>
                            <div class="hidden group-hover:block absolute z-10 left-0 mt-1 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <a href="{{ route('novels.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">BookIt Novel</a>
                                <a href="{{ route('booklist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">BookIt Belajar</a>
                            </div>
                        </div>

                        <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-bold text-white hover:text-blue-200 transition-colors">About Us</a>
                    </div>
                </div>

                <!-- Auth Menu -->
                <div class="flex items-center">
                    @auth
                        <!-- Mobile Menu Button -->
                        <button type="button" @click="mobileMenu = !mobileMenu" class="sm:hidden text-white hover:text-blue-200 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="hidden sm:block relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-white hover:text-blue-200 transition-colors">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                @if(auth()->user()->is_admin)
                                    <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">
                                        Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#37709F] hover:text-white transition-colors">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-[#37709F] bg-white hover:bg-blue-50 transition-colors">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" class="sm:hidden bg-[#37709F]" x-data="{ openKategori: false, openBookList: false }">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('booklist.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">Home</a>
                
                <!-- Mobile Kategori -->
                <div>
                    <button @click="openKategori = !openKategori" class="flex justify-between w-full px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">
                        <span>Kategori</span>
                        <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': openKategori }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openKategori" class="pl-4 space-y-1">
                        <a href="{{ route('category.show', 'smp') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">SMP</a>
                        <a href="{{ route('category.show', 'sma') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">SMA/SMK</a>
                        <a href="{{ route('category.show', 'kejuruan') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">Kejuruan</a>
                    </div>
                </div>

                <!-- Mobile BookList -->
                <div>
                    <button @click="openBookList = !openBookList" class="flex justify-between w-full px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">
                        <span>BookList</span>
                        <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': openBookList }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openBookList" class="pl-4 space-y-1">
                        <a href="{{ route('novels.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">BookIt Novel</a>
                        <a href="{{ route('booklist.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">BookIt Belajar</a>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">About Us</a>

                @auth
                    <div class="border-t border-blue-700 pt-4 pb-3">
                        <div class="px-4">
                            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-blue-200">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                            @if(auth()->user()->is_admin)
                                <a href="/admin" class="block px-4 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">
                                    Admin Panel
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-white hover:bg-blue-700 rounded-md transition-colors">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </header>
</nav>

<!-- Alpine.js untuk mobile menu -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            open: false,
            mobileMenu: false
        }))
    })
</script> 