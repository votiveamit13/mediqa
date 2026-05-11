<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClassModel extends Model
{
    use HasFactory;
    protected $table = 'visa_subclas';
    protected $guarded =[];

   
}
