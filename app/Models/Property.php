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
        return $this->hasOne(Lease::class);
    }

    public function furnitures()
    {
        return $this->belongsToMany(Furniture::class, 'property_furniture', 'property_id', 'furniture_id');
    }
}
