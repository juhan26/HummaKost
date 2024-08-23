<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'property_facilities', 'property_id', 'facility_id');
    }

    public function property_images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
