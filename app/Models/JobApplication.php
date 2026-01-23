<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_posting_id');
    }
    
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }
}
