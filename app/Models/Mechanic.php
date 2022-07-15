<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = [
        'name',
        'number',
        'id_cars',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/mechanics/'.$this->getKey());
    }
}
