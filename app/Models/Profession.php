<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $table = 'profession_data';
    protected $primaryKey = 'profession_id'; // <-- actual column
    protected $guarded =[];

    protected $casts = [
        'is_principal' => 'boolean',
    ];

   
}
