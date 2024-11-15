<x-app-layout x-data="{open:false}">
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <!-- Apply the animation class to the Admissions heading -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-continuous-slide">
                {{ __('Admissions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Apply the animation class to the Admissions list header -->
            <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Admissions list</h2>
            <!-- Add inline style to enforce red background -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white" style="background-color: #dc2626;">
                @foreach($admissions as $admission) 
                    <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                        <h2 class="font-semibold text-xl text-indigo-500">
                            Student: {{$admission->application->student->full_name}}
                        </h2>
                        <p>Course: {{$admission->application->course->course_name}}</p>
                        <p>{{'Faculty of ' . $admission->application->course->faculty->faculty_name}}</p>
                        <p>{{'Institute: ' . $admission->application->course->faculty->institute->institute_name}}</p>
                        <span>{{"Admission date: " . $admission->created_at}}</span>
                    </div>
                @endforeach
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
