<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseApplication extends Model
{
    use HasFactory;

    protected $table = 'nurse_applications';
    protected $guarded = [];

    const STATUS = [
        1  => 'submitted',
        2  => 'under_review',
        3  => 'shortlisted',
        4  => 'interview_scheduled',
        5  => 'interview_completed',
        6  => 'conditional_offer',
        7  => 'offer',
        8  => 'hired',
        9  => 'rejected',
        10 => 'declined',
        11 => 'withdrawn',
    ];

    public function getStatusKeyAttribute()
    {
        return self::STATUS[$this->status] ?? 'unknown';
    }

    public function getStatusLabelAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status_key));
    }

    public function job()
    {
        return $this->belongsTo(JobsModel::class, 'job_id', 'id');
    }

    public function health_care()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id', 'id');
    }
    public function interview()
    {
        return $this->hasOne(InterviewsNurse::class, 'application_id', 'id');
    }
}
