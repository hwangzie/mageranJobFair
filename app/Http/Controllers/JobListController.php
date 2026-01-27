<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::where('status', 'buka')
            ->with('company')
            ->latest();

        if ($request->filled("search")) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled("tipe_pekerjaan")) {
            $query->where('tipe_pekerjaan', $request->tipe_pekerjaan);
        }

        if ($request->filled("lokasi")) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->filled("gaji_min")) {
            $query->where('gaji_min', '>=', $request->gaji_min);
        }

        if ($request->filled("gaji_max")) {
            $query->where('gaji_max', '<=', $request->gaji_max);
        }

        $jobs = $query->paginate(10)->withQueryString();
        return view('job-list.index', compact('jobs'));
    }

    public function show($slug)
    {
        $job = JobPosting::where('slug', $slug)
            ->where('status', 'buka')
            ->with('company')
            ->firstOrFail();

        return view('job-list.show', compact('job'));
    }
}