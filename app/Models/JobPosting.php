<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    //
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
