<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BookIt') }} - Sign Up</title>

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
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Library Background Image (Left Side) -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('/images/Rectangle 39.jpg')"></div>
            
            <!-- Register Form (Right Side) -->
            <div class="w-full md:w-1/2 flex items-center justify-center p-8">
                <div class="w-full max-w-md">
                    <!-- Register Header -->
                    <div class="text-center md:text-left mb-8">
                        <h1 class="text-4xl font-bold mb-2">Sign Up</h1>
                        <p class="text-gray-600">Please enter your details to register</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <input id="name" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" 
                                type="text" name="name" placeholder="Full Name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- NIS/NISN -->
                        <div class="mb-4">
                            <input id="nisn" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" 
                                type="text" name="nisn" placeholder="NIS/NISN" :value="old('nisn')" required />
                            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <input id="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" 
                                type="email" name="email" placeholder="Email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <div class="password-container">
                                <input id="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" 
                                    type="password" name="password" placeholder="Password" required />
                                <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password')"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <div class="password-container">
                                <input id="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500" 
                                    type="password" name="password_confirmation" placeholder="Confirm Password" required />
                                <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password_confirmation')"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="w-full bg-rose-500 text-white py-3 px-4 rounded-md hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                            Sign up
                        </button>

                        <!-- Login Link -->
                        <div class="mt-6 text-center">
                            <div class="text-sm text-gray-600">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-rose-500 hover:text-rose-700">
                                    Sign in
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Divider -->
                    {{-- <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="mx-4 text-sm text-gray-500">or continue with</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>
                    
                    <!-- Social Login Buttons -->
                    <div>
                        <a href="#" class="flex items-center justify-center w-full py-3 px-4 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                            <img class="h-5 w-5 mr-2" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
                            Sign up with Google
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>

        <script>
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);
                const toggleIcon = document.querySelector(`#${inputId} + .toggle-password`);
                
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
