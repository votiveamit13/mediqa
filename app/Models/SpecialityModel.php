<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityModel extends Model
{
    use HasFactory;
    protected $table = 'practitioner_type';
    protected $guarded =[];

    function prentSpecialityName(){
        return  $this->hasOne(SpecialityModel::class,'id','parent');
    }
}
