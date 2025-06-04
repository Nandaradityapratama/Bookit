@php
    use Illuminate\Support\Facades\Storage;
@endphp

<nav x-data="{ open: false }" class="bg-[#F3E4E4] shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
             <!-- Logo -->
             <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="relative group block">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                        class="h-14 w-auto object-contain transition-all duration-300 transform group-hover:scale-110 rounded-lg shadow-md hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-300">
                    </div>
                </a>
                <a href="{{ route('home') }}" class="ml-4 text-xl font-bold text-gray-800">
                    BookIt
                </a>
            </div>
            
            <div class="flex items-center">
                <!-- Logo -->
               

                <!-- Navigation Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('ranking') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Ranking
                    </a>
                    <!-- Dropdown BookList -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            BookList
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ route('booklist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FE4066] hover:text-white">
                                    Buku Pelajaran
                                </a>
                                <a href="{{ route('novels.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FE4066] hover:text-white">
                                    Buku Non-Fiksi
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        About Us
                    </a>
                </div>
            </div>

            <!-- Login/Profile Button -->
            <div class="flex items-center">
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                <div class="py-1">
                                    @if(auth()->user()->is_admin)
                                        <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Admin Panel
                                        </a>
                                    @endif
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-[#FE4066] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#FE4066]/80 active:bg-[#FE4066] focus:outline-none focus:border-[#FE4066] focus:ring ring-[#FE4066]/30 disabled:opacity-25 transition ease-in-out duration-150">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
            <a href="{{ route('ranking') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Ranking</a>
            <a href="{{ route('booklist.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Buku Pelajaran</a>
            <a href="{{ route('novels.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Buku Non-Fiksi</a>
            <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">About Us</a>
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    @if(auth()->user()->is_admin)
                        <a href="/admin" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav> 