<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function properties()
    {
    return $this->belongsTo(Property::class, 'property_id');
    }
    public function payments()
    {
        return $this->hasMany(PaymentPerMonth::class);
    }

    public function feedback(){
        return $this->hasMany(Feedback::class);
    }
}
