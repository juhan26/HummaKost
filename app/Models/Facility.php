<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'description'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_furniture', 'furniture_id', 'property_id');
    }
}
