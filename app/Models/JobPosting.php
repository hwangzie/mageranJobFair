<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    //
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_posting_id');
    }
}
