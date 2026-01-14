<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    //
    public function jobPostings()
    {
        return $this->hasMany(job_posting::class, 'perusahaan_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
