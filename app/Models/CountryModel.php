<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class CountryModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name'
        
        
    ];
}