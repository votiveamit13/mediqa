<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSearches extends Model
{
    use HasFactory;
    protected $table = 'saved_searches';
    protected $primaryKey = 'searches_id';
    protected $guarded =[];
    
    protected $casts = [
        'filters' => 'array',
    ];
}