<x-app-layout x-data="{open:false}">
    <x-slot name="header">
        <!-- Flex container for the header with centered text -->
        <div class="flex justify-between items-center w-full">
            <!-- Center the header text using margin auto -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-continuous-slide mx-auto">
                {{ __('Applications') }}
            </h2>
            @can('institute')
                <form method="POST" action="/control/{{Auth::user()->institute->id}}">
                    @csrf
                    @method("PATCH")
                    @if ((count($applications[1]) > 0))
                        <x-primary-button class="bg-green-500" name="action" value="admission">
                            {{(Auth::user()->institute->control->admissions !== 'open') ? 'Publish Admissions' : 'Published'}}
                        </x-primary-button>
                    @endif
                    <x-primary-button class="bg-green-500" name="action" value="application">
                        {{(Auth::user()->institute->control->applications !== 'open') ? 'Open Applications' : 'Close Applications'}}
                    </x-primary-button>
                </form>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        @can('institute')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Pending Applications</h2>
                <div class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                    @foreach($applications[0] as $application)
                        <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                            <a href="{{'/applications/' . $application->id}}">
                                <h2 class="font-semibold text-xl text-indigo-500">Course: {{$application->course->course_name}}</h2>
                                <p>{{'Faculty of ' . $application->course->faculty->faculty_name}}</p>
                                <p>{{'Institute: ' . $application->course->faculty->institute->institute_name}}</p>
                                <span>{{"Application date: $application->created_at"}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Admitted Applications</h2>
                <div class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                    @foreach($applications[1] as $application)
                        <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                            <a href="{{'/applications/' . $application->id}}">
                                <h2 class="font-semibold text-xl text-indigo-500">Course: {{$application->course->course_name}}</h2>
                                <p>{{'Faculty of ' . $application->course->faculty->faculty_name}}</p>
                                <p>{{'Institute: ' . $application->course->faculty->institute->institute_name}}</p>
                                <span>{{"Application date: $application->created_at"}}</span>
                                <span class="block">{{"Admitted date: $application->updated_at"}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Waitlisted Applications</h2>
                <div class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                    @foreach($applications[2] as $application)
                        <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                            <a href="{{'/applications/' . $application->id}}">
                                <h2 class="font-semibold text-xl text-indigo-500">Course: {{$application->course->course_name}}</h2>
                                <p>{{'Faculty of ' . $application->course->faculty->faculty_name}}</p>
                                <p>{{'Institute: ' . $application->course->faculty->institute->institute_name}}</p>
                                <span>{{"Application date: $application->created_at"}}</span>
                                <span>{{"Admitted date: $application->updated_at"}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Rejected Applications</h2>
                <div class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                    @foreach($applications[3] as $application)
                        <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                            <a href="{{'/applications/' . $application->id}}">
                                <h2 class="font-semibold text-xl text-indigo-500">Course: {{$application->course->course_name}}</h2>
                                <p>{{'Faculty of ' . $application->course->faculty->faculty_name}}</p>
                                <p>{{'Institute: ' . $application->course->faculty->institute->institute_name}}</p>
                                <span>{{"Application date: $application->created_at"}}</span>
                                <span>{{"Admitted date: $application->updated_at"}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endcan

        @can('student')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold pb-3 text-xl animate-continuous-slide">Your Applications</h2>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                    @foreach($applications as $application)
                        <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                            <a href="{{'/applications/' . $application->id}}">
                                <h2 class="font-semibold text-xl text-indigo-500">Course: {{$application->course->course_name}}</h2>
                                <p>{{'Faculty of ' . $application->course->faculty->faculty_name}}</p>
                                <p>{{'Institute: ' . $application->course->faculty->institute->institute_name}}</p>
                                <span>{{"Application date: $application->created_at"}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endcan

        @if (session('status') === 'application-created')
            <x-confirm-modal :name="'create'" :content="'The application submitted successfully'">
            </x-confirm-modal>
        @endif
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
