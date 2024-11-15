<x-app-layout x-data="{ open: false }" class="bg-red-600">
    <x-slot name="header">
        <div class="flex justify-between items-center bg-red-700 p-4 rounded-md">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __($course->course_name) }}
            </h2>
            <div>
                @auth
                    @can('action-on-course', $course->id)
                        <a href="{{ $course->id }}/edit">
                            <x-primary-button class="bg-red-500 text-white">Edit course</x-primary-button>
                        </a>
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-course-deletion')" class="bg-red-700">
                            {{ __('Delete course') }}
                        </x-danger-button>
                    @endcan
                    @can('student')
                        @if ($course->faculty->institute->control->applications === 'open')
                            <a href="{{ $course->id }}/apply">
                                <x-primary-button class="bg-green-500 text-white">Apply</x-primary-button>
                            </a>
                        @else
                            <x-primary-button class="bg-gray-400 text-white" disabled>Applications closed</x-primary-button>
                        @endif
                    @endcan
                @endauth
            </div>
        </div>
    </x-slot>

    <x-modal name="confirm-course-deletion" :show="$errors->courseDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ $course->id }}" class="p-6 bg-red-700 text-white rounded-lg">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium">Are you sure you want to delete this course: {{ $course->course_name }}?</h2>
            <p class="mt-1 text-sm">This course will be permanently deleted.</p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="bg-gray-500 text-white">Cancel</x-secondary-button>
                <x-danger-button class="ms-3 bg-red-900 text-white">Delete Course</x-danger-button>
            </div>
        </form>
    </x-modal>

    <div class="py-12 px-6 bg-red-600 text-white">
        <section
            class="flex flex-col p-6 bg-red-800 text-white rounded-lg shadow-xl dark:ring-1 dark:ring-gray-800">
            <div class="md:flex md:items-start md:justify-between md:gap-2">
                <div class="min-w-0">
                    <div
                        class="inline-block rounded-full bg-gray-600 px-3 py-2 text-lg font-bold leading-5 text-white truncate lg:text-base">
                        About the course
                    </div>
                    <div class="mt-4 text-lg font-semibold">Course description: {{ $course->description }}</div>
                    <div class="mt-4 text-lg font-semibold">Course Level: {{ $course->level }}</div>
                    <div class="mt-4 text-lg font-semibold">Duration: {{ $course->course_duration }}</div>
                    <div class="mt-4 text-lg font-semibold">Tuition fee (per annum): {{ $course->price }}</div>
                    <div class="mt-4 text-lg font-semibold">Institute: {{ $course->faculty->institute->institute_name }}</div>
                    <div class="mt-4 text-lg font-semibold">Institute Location: {{ $course->faculty->institute->location }}</div>
                </div>
                <div class="hidden text-right shrink-0 md:block">
                    <span class="inline-block rounded-full bg-gray-700 px-3 py-2 text-sm text-white truncate">
                        Faculty: {{ $course->faculty->faculty_name }}
                    </span>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto my-6">
            <h2 class="font-semibold text-xl">Course Requirements</h2>
            <div id="credits" data-passed="{{ $course->passed_subject }}" data-credits="{{ $course->credits }}"
                class="bg-red-700 p-8 rounded-lg shadow-lg text-white">
                <p class="text-lg">To apply, you must pass {{ $course->pass }} subjects, including
                    {{ $course->passed_subject }}. Credits in {{ $course->credits }} are also required.</p>
                <p class="text-lg">{{ $course->requirements }}</p>
            </div>
        </div>

        @if (session('status') === 'course-updated')
            <x-confirm-modal :name="'update'" :content="'The course updated successfully'">
            </x-confirm-modal>
        @endif
        @if (session('status') === 'course-created')
            <x-confirm-modal :name="'create'" :content="'The course created successfully'">
            </x-confirm-modal>
        @endif
    </div>
</x-app-layout>
