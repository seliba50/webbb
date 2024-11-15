<nav x-data="{ open: false }" class="bg-red-600 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Dropdown Navigation Menu -->
                <div class="relative">
                    <button @click="open = !open" class="text-white px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                        Menu
                        <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown menu items -->
                    <div x-show="open" x-transition class="absolute left-0 mt-2 w-48 bg-red-600 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="/dashboard" class="text-white block px-4 py-2 text-sm">Dashboard</a>
                            <a href="/" class="text-white block px-4 py-2 text-sm">Home</a>
                            <a href="/institutes" class="text-white block px-4 py-2 text-sm">Institutes</a>
                            @auth
                                @if(Auth::user()?->institute)
                                    <a href="/faculty" class="text-white block px-4 py-2 text-sm">Faculties</a>
                                @endif
                            @endauth
                            <a href="/courses" class="text-white block px-4 py-2 text-sm">Courses</a>
                            @auth
                                <a href="/applications" class="text-white block px-4 py-2 text-sm">Applications</a>
                                <a href="/admissions" class="text-white block px-4 py-2 text-sm">Admissions</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings and Authentication Links -->
            <div class="flex">
                @guest
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-link-button>
                            Login
                        </x-link-button>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ 'Register'}}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="/student/register">
                                    {{ __('Student') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="/institute/register">
                                    {{ __('Institute') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endguest

                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
