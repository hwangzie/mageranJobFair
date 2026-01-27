<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($jobs->count() > 0)
                        <div class="space-y-4">
                            @foreach($jobs as $job)
                                <div class="border rounded-lg p-6 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900">
                                                {{ $job->title }}
                                            </h3>
                                            <p class="text-gray-600 mt-1">
                                                {{ $job->perusahaan->nama_perusahaan }}
                                            </p>
                                            <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                                <span>📍 {{ $job->lokasi }}</span>
                                                <span>💼 {{ $job->tipe_pekerjaan }}</span>
                                                @if($job->gaji_min && $job->gaji_max)
                                                    <span>💰 Rp {{ number_format($job->gaji_min) }} - Rp {{ number_format($job->gaji_max) }}</span>
                                                @endif
                                            </div>
                                            <p class="mt-3 text-gray-700 line-clamp-2">
                                                {{ Str::limit(strip_tags($job->deskripsi), 150) }}
                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('jobs.show', $job->slug) }}" 
                                               class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-400">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $jobs->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No job postings available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>