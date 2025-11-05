<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link 
        href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Parisienne&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik+Glitch&family=Saira+Stencil+One&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" 
        rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="flex max-w-100vw w-full">
        {{-- Left Section --}}
        <div class="relative overflow-hidden h-screen">
            <div class="h-screen bg-no-repeat bg-cover bg-center flex flex-col"
            style="background-image: url('{{ asset('svg/Group 13.svg') }}')">
            <div class="flex flex-col w-1/2 justify-between h-full px-16 py-8">
            <h1 class="text-4xl font-bold mb-6 text-[#E1EEBC]">INILAH MY IUNO</h1>
            <p class="text-2xl pr-12 text-white">
                Iuno in Wuthering Waves is a 5 Stars Aero character who wields a Gauntlets as their weapon type.
                She is favored by fate under one name, and swept away by it in another. Yet never once has she been defeated, nor has she ever yielded. Now, witness the defiant Priestess. Witness what keeps her striding forward, never to look back. Witness how she walks the intricate web of destiny and becomes the only answer.
            </p>
            <div class="flex items-center space-x-4">
                <p class="text-[#E1EEBC] italic">Teamwork makes the dream work</p>
            </div>
            </div>

            </div>
        </div>

        {{-- Right Section --}}
        <div class="absolute top-0 right-0 w-1/2 h-full flex items-center justify-center p-8">

            <p class="text-3xl absolute top-8 right-8 pr-5 text-[#016B61] font-bold">
    
                K<span style="font-family: 'Parisienne', cursive; font-weight: normal;">enal</span>&nbsp;B<span style="font-family: 'Parisienne', cursive; font-weight: normal;">ersih</span>

            </p>

            <div class="w-full max-w-md">

                <h2 class="text-xl mb-4 text-center text-[#328E6E]">Selamat datang</h2>
                <p class="text-sm text-gray-500 mb-8 text-center px-12">Mari lakukan yang terbaik untuk menjaga kebersihan bersama.</p>


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 px-3 py-3 w-full bg-gray-200" type="email" name="email" placeholder="user@gmail.com"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 px-3 py-3 w-full bg-gray-200" type="password" placeholder="Masukkan Password"
                            name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex mt-4 justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 shadow-sm"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="underline text-[#328E6E] hover:text-[#016B61] text-sm"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-6"> 
                        <button type="submit" 
                            class="w-full justify-center inline-flex items-center px-4 py-3 border border-transparent 
                            rounded-md font-semibold text-base text-white uppercase tracking-widest 
                            
                            bg-linear-to-r from-[#5BA58B] to-[#328E6E] 
                            
                            hover:brightness-110 focus:outline-none transition-all">
                            
                            {{ __('Log in') }}
                            
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    {{ __("Belum punya akun?") }}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="font-medium underline text-[#328E6E] hover:text-[#016B61]">
                            {{ __('Daftar') }}
                        </a>
                    @endif
                </p>

            </div>

        </div>
    </div>
</body>

</html>

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="absolute inset-0 flex min-h-screen w-full">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    </div>
</x-guest-layout> --}}