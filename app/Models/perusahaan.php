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
    public function users()
    {
        return $this->hasMany(user::class, 'perusahaan_id');
    }
}
