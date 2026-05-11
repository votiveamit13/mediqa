<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseJobLike extends Model
{
    use HasFactory;
    protected $table = 'nurse_job_likes';
    protected $guarded = [];
}
