<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{name:''}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <h2 class="font-medium">Update Faculty</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                @include('includes.edit-faculty')
            </div>
        </div>
    </div>
</x-app-layout>