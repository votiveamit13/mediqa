<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardsModel extends Model
{
    use HasFactory;
    protected $table = 'awards_recognitions';
    protected $guarded =[];
}
