<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'title',
        'slug',
        'deskripsi',
        'syarat',
        'lokasi',
        'tipe_pekerjaan',
        'gaji_min',
        'gaji_max',
        'status',
    ];

    protected $casts = [
        'gaji_min' => 'decimal:2',
        'gaji_max' => 'decimal:2',
    ];

    /**
     * Get the company (user) that owns the job posting
     */
    public function company()
    {
        return $this->belongsTo(User::class, 'perusahaan_id');
    }

    /**
     * Get the perusahaan profile for the job posting
     */
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'user_id');
    }

    /**
     * Get all job applications for this posting
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
