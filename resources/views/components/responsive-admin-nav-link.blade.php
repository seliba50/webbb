@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex gap-2 text-indigo-500 w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'flex gap-2 w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-100 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>