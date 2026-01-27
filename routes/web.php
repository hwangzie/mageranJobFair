<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // jobs listing and details accessible to all authenticated users
    Route::get('/jobs', [\App\Http\Controllers\JobListController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{slug}', [\App\Http\Controllers\JobListController::class, 'show'])->name('jobs.show');
    
    // Job seekers and admin can apply for jobs
    Route::resource('job-applications', \App\Http\Controllers\JobApplicationController::class);
});

// Companies and admin can manage job postings
Route::middleware(['auth', 'company'])->group(function () {
    Route::resource('job-postings', \App\Http\Controllers\JobPostingController::class);
});




// Admin only routes (optional - add admin panel later)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
