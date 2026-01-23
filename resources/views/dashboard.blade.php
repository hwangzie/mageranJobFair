<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isAdmin())
                        <h3 class="text-2xl font-bold mb-4">Admin Dashboard</h3>
                        <p>Welcome, Admin! You have full access to all features.</p>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('job-postings.index') }}" class="block text-blue-600 hover:underline">
                                → Manage Job Postings
                            </a>
                            <a href="{{ route('job-applications.index') }}" class="block text-blue-600 hover:underline">
                                → View Job Applications
                            </a>
                        </div>

                    @elseif(auth()->user()->isCompany())
                        <h3 class="text-2xl font-bold mb-4">Company Dashboard</h3>
                        <p>Welcome, {{ auth()->user()->name }}!</p>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('job-postings.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                View My Job Postings
                            </a>
                            <a href="{{ route('job-postings.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">
                                Create New Job Posting
                            </a>
                        </div>

                    @else
                        <h3 class="text-2xl font-bold mb-4">Job Seeker Dashboard</h3>
                        <p>Welcome, {{ auth()->user()->name }}!</p>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('job-applications.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                My Applications
                            </a>
                            <a href="{{ route('job-postings.index') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">
                                Browse Jobs
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
