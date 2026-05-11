<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsModel extends Model
{
    use HasFactory;
    protected $table = 'job_boxes';
    protected $guarded =[];

    protected $casts = [
        'shift_type' => 'array',
        'typeofspeciality' => 'array',
        'nurse_type_id' => 'array',
        // 'location_state' => 'array',
        'emplyeement_type' => 'array',
    ];


    public function getShiftNamesAttribute()
    {
        if (!$this->shift_type) {
            return [];
        }

        return WorkshiftModel::whereIn('work_shift_id', $this->shift_type)
            ->pluck('shift_name')
            ->toArray();
    }

    public function getEmploymentTypeAttribute()
    {

        if (!$this->emplyeement_type) {
            return null;
        }

        return EmpTypeModel::where('emp_prefer_id', $this->emplyeement_type)
            ->value('emp_type');
    }

    public function getHealthCareNameAttribute()
    {
        if (!$this->healthcare_id) {
            return null;
        }

        return User::where('id', $this->healthcare_id)
            ->value('name');
    }

    public function getCountryNameAttribute()
    {
        if (!$this->location_country) {
            return null;
        }

        return CountryModel::where('iso2', $this->location_country)
            ->value('name');
    }
    public function getStateNameAttribute()
    {
        if (!$this->location_state) {
            return null;
        }

        return StateModel::where('id', $this->location_state)
            ->value('name');
    }

    /**
     * Get the healthcare facility that posted the job
     */
    public function postedBy()
    {
        return $this->belongsTo(User::class, 'healthcare_id');
    }

}
