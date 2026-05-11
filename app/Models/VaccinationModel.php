<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationModel extends Model
{
    use HasFactory;
    protected $table = 'vaccination';
    protected $guarded =[];   
}