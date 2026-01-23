<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        // Check if user is a company
        if (!auth()->user()->isCompany()) {
            abort(403, 'Only companies can post jobs');
        }
        return view('job-postings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            // ... other fields
        ]);

        auth()->user()->perusahaan->jobPostings()->create($validated);
        
        return redirect()->route('job-postings.index');
    }
}
