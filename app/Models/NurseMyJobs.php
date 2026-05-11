<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseMyJobs extends Model
{
    use HasFactory;

    protected $table = 'nurse_myjobs';
    protected $guarded = [];

    public function health_care()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }

    public function state_name()
    {
        return $this->belongsTo(StateModel::class, 'location_state_id', 'id');
    }
    public function application()
    {
        return $this->belongsTo(NurseApplication::class, 'application_id', 'id');
    }
    public function shift_type_show()
    {
        return $this->belongsTo(WorkshiftModel::class, 'shift_type', 'work_shift_id');
    }
}
