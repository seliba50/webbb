<x-app-layout x-data="{open:false}">
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __() }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <img src="images.jpg" alt="" class="-z-10 fixed w-full h-full top-0 right-0 left-0 bottom-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 overflow-hidden shadow-sm sm:rounded-lg p-8 text-white">
                <div class="w-full flex flex-col items-center gap-6 justify-center">
                    <!-- Applying Sliding Animation to the Heading -->
                    <h1 class="font-bold text-4xl text-center text-transparent bg-clip-text bg-gradient-to-r from-[#ff00d2] to-[#fed90f] animate-slide">
                        Welcome to Your Future - Explore Opportunities and Shape Your Success!
                    </h1> 
                    <!-- Applying Sliding Animation to the Paragraph -->
                    <p class="text-center animate-slide">Discover top higher education institutions and apply for courses that align with your qualifications</p> 
                    <div class="flex flex-col items-center">
                        <a href="/institute/register">
                            <x-primary-button class="flex items-center justify-center hover:bg-gray-300 w-[fit-content] bg-gradient-to-r from-[#ff00d2] via-red-800 to-yellow-200 py-[1.5px] px-[1.5px]">
                            </x-primary-button> 
                        </a>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Add this CSS for sliding animation -->
<style>
    /* Keyframes for sliding animation from left to right and right to left */
    @keyframes slide {
        0% {
            transform: translateX(-100%); /* Start off-screen to the left */
        }
        50% {
            transform: translateX(0); /* Slide to its original position */
        }
        100% {
            transform: translateX(100%); /* Slide off-screen to the right */
        }
    }

    /* Apply the sliding animation to both h1 and p */
    .animate-slide {
        animation: slide 4s ease-in-out infinite; /* Adjust duration and ease as needed */
    }
</style>
