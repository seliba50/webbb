<x-app-layout>
    <x-slot name="header">
        <!-- Centered Header with Continuous Slide Animation -->
        <div class="flex justify-center items-center overflow-hidden">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide">
                {{ __('Institute Registration') }}
            </h2>
        </div>
    </x-slot>

    <!-- Page Background with Red Color -->
    <div style="background-color: #EF4444; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <x-guest>
            <!-- Form Container with White Background and Padding -->
            <div style="background-color: white; padding: 24px; border-radius: 8px; max-width: 600px;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <x-text-input id="institute" class="block mt-1 w-full" type="hidden" name="register_as" value="institute" required/>

                    <!-- Name -->
                    <div>
                        <x-input-label for="institute_name" :value="__('Institute Name')" />
                        <x-text-input id="institute_name" class="block mt-1 w-full" type="text" name="institute_name" :value="old('institute_name')" required autofocus autocomplete="institute_name" />
                        <x-input-error :messages="$errors->get('institute_name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Location -->
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required/>
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-guest>
    </div>

    <!-- Continuous Slide Animation for Header Text -->
    <style>
        @keyframes slide {
            0% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        
        .animate-slide {
            animation: slide 5s linear infinite;
            white-space: nowrap;
            display: inline-block;
        }
    </style>
</x-app-layout>
