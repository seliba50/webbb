<x-app-layout x-data="{open:false}">
    <x-slot name="header">
        <!-- Center the header using flex utilities -->
        <div class="flex justify-center items-center">
            <!-- Add the animation class for continuous sliding effect -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-continuous-slide">
                {{ __('Institutes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold pb-3 text-xl">Institutes list</h2>
            <div
                class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg p-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-3 text-white">
                @foreach($institutes as $institute) 
                    <div class="bg-gray-700 fr-1 rounded-lg py-2 px-4 shadow-md">
                        <h2 class="font-semibold text-xl text-indigo-500">Institute:
                            {{$institute->institute_name}}</h2>
                        <p>{{'Location: ' . $institute->location}}</p>
                    </div>
                @endforeach
            </div>
        </div>
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
