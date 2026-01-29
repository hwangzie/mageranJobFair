<x-metronic-layout>
    <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
        <!--begin::Title-->
        <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">
            Dashboard
            <br />
            <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                <span id="kt_landing_hero_text">Welcome Back!</span>
            </span>
        </h1>
        <!--end::Title-->
    </div>

    <div class="px-5">
        <div class="card shadow-sm" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08)); background: rgba(255, 255, 255, 0.95);">
            <div class="card-body p-lg-10">
                @if(auth()->user()->isAdmin())
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Admin Dashboard</h3>
                    <p class="text-gray-600 mb-6">Welcome, Admin! You have full access to all features.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('job-postings.index') }}" class="btn btn-primary">
                            Manage Job Postings
                        </a>
                        <a href="{{ route('job-applications.index') }}" class="btn btn-light-primary">
                            View Job Applications
                        </a>
                    </div>

                @elseif(auth()->user()->isCompany())
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Company Dashboard</h3>
                    <p class="text-gray-600 mb-6">Welcome, {{ auth()->user()->name }}!</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('job-postings.index') }}" class="btn btn-primary">
                            View My Job Postings
                        </a>
                        <a href="{{ route('job-postings.create') }}" class="btn btn-success">
                            Create New Job Posting
                        </a>
                    </div>

                @else
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Job Seeker Dashboard</h3>
                    <p class="text-gray-600 mb-6">Welcome, {{ auth()->user()->name }}!</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('job-applications.index') }}" class="btn btn-primary">
                            My Applications
                        </a>
                        <a href="{{ route('job-postings.index') }}" class="btn btn-success">
                            Browse Jobs
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-metronic-layout>
