<x-app-layout>
    <x-slot name="header">
        <!-- Center the header using flex utilities -->
        <div class="flex justify-center items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-continuous-slide">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold pb-3 text-xl">Your stats</h2>
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3"
                style="background-color: red"> <!-- Red background here -->
                @can('institute')
                    <!-- Faculties Card -->
                    <x-dashboard-card title="Faculties" style="background-color: #fff; color: #000;">
                        {{ Auth::user()?->institute?->faculty?count(Auth::user()?->institute?->faculty):0 }}
                    </x-dashboard-card>

                    <!-- Courses Card -->
                    <x-dashboard-card title="Courses" style="background-color: #fff; color: #000;">
                        {{ count($courses) }}
                    </x-dashboard-card>

                    <!-- Applications Card -->
                    <x-dashboard-card title="Applications" style="background-color: #fff; color: #000;">
                        {{ count($applications) }}
                    </x-dashboard-card>

                    <!-- Admissions Card -->
                    <x-dashboard-card title="Admissions" style="background-color: #fff; color: #000;">
                        {{ count($admissions) }}
                    </x-dashboard-card>
                @endcan

                @can('student')
                    <!-- Applications Card for Student -->
                    <x-dashboard-card title="Applications" style="background-color:yellow; color: blue;">
                        {{ count(Auth::user()?->student?->application) }}
                    </x-dashboard-card>

                    <!-- Courses Applied for Card -->
                    <x-dashboard-card title="Courses " style="background-color: blue; color: red;">
                        {{ count(Auth::user()?->student?->application) }}
                    </x-dashboard-card>

                    <!-- Institutes Card -->
                    <x-dashboard-card title="Institutes" style="background-color: #fff; color: #000;">
                        {{ count($student_institutes) }}
                    </x-dashboard-card>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tailwind CSS Custom Animation Styles -->
<style>
    @keyframes continuousSlide {
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

    .animate-continuous-slide {
        animation: continuousSlide 5s linear infinite;
        white-space: nowrap;
        display: inline-block;
    }
</style>
