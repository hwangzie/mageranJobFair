<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Crypt;

class JobPostingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'company']);
    }
    public function index()
    {
        return view('job-postings.index');
    }
    public function create()
    {
        return view('job-postings.create');
    }
    public function datatable(Request $request){
         if ($request->ajax()) {
            $query = JobPosting::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('salary_range', function ($row) {
                    return 'Rp ' . number_format($row->salary_min, 0, ',', '.') . ' - Rp ' . number_format($row->salary_max, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('job-postings.edit', Crypt::encrypt($row->id)).'" class="btn btn-warning p-2"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger p-2 btn-delete" data-id="'. Crypt::encrypt($row->id).'"><i class="fas fa-trash-alt"></i></a>
                    ';
                })
                ->rawColumns(['deskripsi', 'syarat', 'action'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string|max:255',
                'requirements' => 'nullable|string',
                'salary_min' => 'required|string|max:255',
                'salary_max' => 'required|string|max:255',
                'job_type' => 'required|string|max:100',
            ],
            [
                'title.required' => 'Nama Pekerjaan Wajib Diisi',
                'title.max' => 'Nama Pekerjaan Maksimal 255 Karakter',
                'description.required' => 'Deskripsi Pekerjaan Wajib Diisi',
                'location.required' => 'Lokasi Pekerjaan Wajib Diisi',
                'job_type.required' => 'Jenis Pekerjaan Wajib Diisi',
                'salary_min.required' => 'Gaji Minimal Wajib Diisi',
                'salary_max.required' => 'Gaji Maksimal Wajib Diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();

        $salaryMin = (int) str_replace('.', '', $request->salary_min);
        $salaryMax = (int) str_replace('.', '', $request->salary_max);

        try {
            $job = new JobPosting();
            $job->perusahaan_id = auth()->user()->perusahaan->id;
            $job->title = $validated['title'];
            $job->slug = Str::slug('job-' . uniqid());
            $job->deskripsi = $validated['description'];
            $job->lokasi = $validated['location'];    
            $job->syarat = $validated['requirements'] ?? null;
            $job->gaji_min = $salaryMin;
            $job->gaji_max = $salaryMax;
            $job->tipe_pekerjaan = $validated['job_type'];
            $job->save();
            return redirect()
                ->route('job-postings.create')
                ->with('success', 'Lowongan Pekerjaan berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal membuat lowongan pekerjaan: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function edit($id)
    {
        $job_posting = JobPosting::findOrFail(Crypt::decrypt($id));
        return view('job-postings.edit', compact('job_posting', 'id'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string|max:255',
                'requirements' => 'nullable|string',
                'salary_min' => 'required|string|max:255',
                'salary_max' => 'required|string|max:255',
                'job_type' => 'required|string|max:100',
            ],
            [
                'title.required' => 'Nama Pekerjaan Wajib Diisi',
                'title.max' => 'Nama Pekerjaan Maksimal 255 Karakter',
                'description.required' => 'Deskripsi Pekerjaan Wajib Diisi',
                'location.required' => 'Lokasi Pekerjaan Wajib Diisi',
                'job_type.required' => 'Jenis Pekerjaan Wajib Diisi',
                'salary_min.required' => 'Gaji Minimal Wajib Diisi',
                'salary_max.required' => 'Gaji Maksimal Wajib Diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();
        $salaryMin = (int) str_replace('.', '', $request->salary_min);
        $salaryMax = (int) str_replace('.', '', $request->salary_max);

        try {
            $id = Crypt::decrypt($id);
            $job_posting = JobPosting::findOrFail($id);
            $job_posting->title = $validated['title'];
            $job_posting->deskripsi = $validated['description'];
            $job_posting->lokasi = $validated['location'];    
            $job_posting->syarat = $validated['requirements'] ?? null;
            $job_posting->gaji_min = $salaryMin;
            $job_posting->gaji_max = $salaryMax;
            $job_posting->tipe_pekerjaan = $validated['job_type'];
            $job_posting->save();
            return redirect()
                ->route('job-postings.edit', Crypt::encrypt($job_posting->id))
                ->with('success', 'Lowongan Pekerjaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal memperbarui lowongan pekerjaan: ' . $e->getMessage()])
                ->withInput();
        };
    }
    public function delete(Request $request)
    {
        $id = Crypt::decrypt($request->input('id'));
       
        try {
            $job_posting = JobPosting::findOrFail($id);
            $job_posting->delete();
            return response()->json(['success' => true, 'message' => 'Lowongan Pekerjaan berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus lowongan pekerjaan: ' . $e->getMessage()]);
        }
    }
}
