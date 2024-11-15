<x-app-layout x-data="{open:false}">
    <x-slot name="header">
        <div class="flex justify-center align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide">
                {{ __('Create Course') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <h2 class="font-semibold pb-3 text-xl">New Course</h2>
            <div class="bg-white overflow-hidden shadow-sm max-[640px]:rounded-lg sm:rounded-lg p-8">
                @include('course.course-form')
            </div>
        </div>
    </div>

    <style>
        /* Slide animation for the header */
        @keyframes slide {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            50% {
                transform: translateX(10%);
                opacity: 0.5;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide {
            animation: slide 3s ease-in-out infinite;
        }
    </style>
</x-app-layout>
