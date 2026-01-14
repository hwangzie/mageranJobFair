<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_application extends Model
{
    //
    public function jobPosting()
    {
        return $this->belongsTo(job_posting::class, 'job_posting_id');
    }
    
    public function jobSeeker()
    {
        return $this->belongsTo(job_seeker::class, 'job_seeker_id');
    }
}
