<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'property_id',
        'image',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
