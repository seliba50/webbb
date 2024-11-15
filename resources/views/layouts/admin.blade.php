<nav x-data="{ open: false, menuOpen: false, adminMenuOpen: false }" :class="open && 'pb-3'" class="bg-red-600 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left-Aligned Dropdown Menu -->
            <div class="flex items-center">
                <!-- Main Menu Dropdown (Visible for all users) -->
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button @click="menuOpen = !menuOpen" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-200 bg-red-700 rounded-md hover:bg-red-800 focus:outline-none transition duration-150 ease-in-out">
                            <div>Menu</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="/" :active="request()->is('/')">
                            {{ __('Home') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/institutes" :active="request()->is('institutes') || request()->is('institutes/*')">
                            {{ __('Institutes') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/courses" :active="request()->is('courses') || request()->is('course/*')">
                            {{ __('Courses') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Admin Dropdown Menu (Visible for Admin Role) -->
                @auth
                @if(auth()->user()->role == 'admin')
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button @click="adminMenuOpen = !adminMenuOpen" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-200 bg-red-700 rounded-md hover:bg-red-800 focus:outline-none transition duration-150 ease-in-out">
                            <div>Admin Menu</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="/dashboard" :active="request()->is('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/institutes" :active="request()->is('institutes')">
                            {{ __('Institutes') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/faculties" :active="request()->is('faculties')">
                            {{ __('Faculties') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/courses" :active="request()->is('courses')">
                            {{ __('Courses') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/application" :active="request()->is('application')">
                            {{ __('Application') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="/admin" :active="request()->is('admin')">
                            {{ __('Admin') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endif
                @endauth
            </div>

            <!-- Centered Login and Register Links -->
            <div class="flex items-center justify-center flex-1">
                @guest
                <div class="flex space-x-6">
                    <x-link-button href="/login">
                        {{ __('Login') }}
                    </x-link-button>
                    <x-dropdown align="center" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ 'Register' }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
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
            </div>

            <!-- Right-Aligned Settings Dropdown for Authenticated Users -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth
        </div>
    </div>
</nav>
