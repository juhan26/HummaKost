<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'property_id');
    }
}
