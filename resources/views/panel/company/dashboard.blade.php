<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as a Company!") }}
                    <div class="mt-4">
                        <h3 class="font-bold text-lg">Your Actions</h3>
                        <ul class="list-disc pl-5 mt-2">
                            <li>Post a new job</li>
                            <li>View applicants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-company-layout>
