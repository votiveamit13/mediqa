<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImmStatusModel extends Model
{
    use HasFactory;
    protected $table = 'imm_status';
    protected $guarded = [];
}
