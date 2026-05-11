<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddReferee extends Model
{
    use HasFactory;
    protected $table = 'referee';
    protected $guarded =[];
}
