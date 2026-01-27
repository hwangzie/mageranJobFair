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
    
    // Job seekers and admin can apply for jobs
    Route::resource('job-applications', \App\Http\Controllers\JobApplicationController::class);
});

// Companies and admin can manage job postings
Route::middleware(['auth', 'company'])->group(function () {
    Route::prefix('job-postings')->group(function () {
        Route::get('/', [\App\Http\Controllers\JobPostingController::class, 'index'])->name('job-postings.index');
        Route::get('/create', [\App\Http\Controllers\JobPostingController::class, 'create'])->name('job-postings.create');
        Route::post('/store', [\App\Http\Controllers\JobPostingController::class, 'store'])->name('job-postings.store');
        Route::get('/datatable', [\App\Http\Controllers\JobPostingController::class, 'datatable'])->name('job-postings.datatable');
        Route::get('/edit/{id}', [\App\Http\Controllers\JobPostingController::class, 'edit'])->name('job-postings.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\JobPostingController::class, 'update'])->name('job-postings.update');
        Route::delete('/delete', [\App\Http\Controllers\JobPostingController::class, 'delete'])->name('job-postings.delete');
    });
});


// Admin only routes (optional - add admin panel later)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
