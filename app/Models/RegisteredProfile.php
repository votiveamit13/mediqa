<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredProfile extends Model
{
    use HasFactory;

    protected $table = 'registration_profiles_countries';
    protected $guarded = [];
    public $timestamps = true;
}
