<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewsNurse extends Model
{
    use HasFactory;
    protected $table = 'interview_nurses';
    protected $guarded = [];

   
    public function job()
    {
        return $this->belongsTo(JobsModel::class, 'job_id', 'id');
    }

    public function health_care()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }

    public function getMeetingTypeLabelAttribute()
    {
        $types = [
            1 => 'On-site',
            2 => 'Zoom',
            3 => 'Teams',
            4 => 'Google Meet',
            5 => 'Other',
        ];

        return $types[$this->meeting_type] ?? 'Unknown';
    }
  
}
