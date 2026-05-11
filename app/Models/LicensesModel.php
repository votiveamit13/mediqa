<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensesModel extends Model
{
    use HasFactory;
    protected $table = 'user_licenses_details';
    protected $guarded =[];

   
}