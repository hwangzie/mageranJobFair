<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_seeker extends Model
{
    //
    public function jobApplications()
    {
        return $this->hasMany(job_application::class, 'job_seeker_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
