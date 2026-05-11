<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NdisWorker extends Model
{
    use HasFactory;
    protected $table = 'ndis_screening_check';
    protected $guarded =[];
}
