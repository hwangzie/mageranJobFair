<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_posting extends Model
{
    //
    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class, 'perusahaan_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(job_application::class, 'job_posting_id');
    }
}
