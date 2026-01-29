<x-seeker-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Seeker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as a Job Seeker!") }}
                    <div class="mt-4">
                        <h3 class="font-bold text-lg">Find your dream job</h3>
                        <div class="mt-2">
                            <!-- Search bar placeholder -->
                            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" placeholder="Search for jobs...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-seeker-layout>
