<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSpecialitiesModel extends Model
{
    use HasFactory;
    protected $table = 'sub_job_specialities';
    protected $guarded =[];

    function prentSpecialityName(){
        return  $this->hasOne(PractitionerTypeModel::class,'id','parent');
    }
}
