<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BookIt') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome untuk icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .password-container {
                position: relative;
            }
            .toggle-password {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #666;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen">
            <!-- Left side - Image -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('/images/Rectangle 39.jpg')"></div>

            <!-- Right side - Login Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center px-8">
                <div class="w-full max-w-md">
                    <h2 class="text-3xl font-bold mb-6">Sign In</h2>
                    <p class="text-gray-600 mb-8">Please enter your login details to sign in</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- NISN -->
                        <div>
                            <x-input-label for="nisn" value="NIS/NISN" />
                            <x-text-input id="nisn" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" type="text" name="nisn" :value="old('nisn')" required autofocus autocomplete="nisn" />
                            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" value="Password" />
                            <div class="password-container">
                                <x-text-input id="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
                                <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password')"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-[#FE4066] hover:text-[#FE4066]/80" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="w-full bg-rose-500 text-white py-3 px-4 rounded-md hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                            Log in
                        </button>

                        <div class="mt-6 text-center">
                            <div class="text-sm text-gray-600">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-[#FE4066] hover:text-[#FE4066]/80">
                                    Sign up
                                </a>
                            </div>
                        </div>

                        <!-- Divider -->
                        {{-- <div class="mt-6 flex items-center justify-center">
                            <span class="px-2 text-gray-500">or continue with</span>
                        </div>

                        <!-- Social Login -->
                        <div class="mt-6">
                            <a href="#" class="w-full flex items-center justify-center px-4 py-2 border rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <img class="h-5 w-5 mr-2" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
                                Sign in with Google
                            </a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>

        <script>
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);
                const toggleIcon = document.querySelector('.toggle-password');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            }
        </script>
    </body>
</html>
