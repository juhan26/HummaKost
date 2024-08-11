<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPerMonth extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function lease(){
        return $this->belongsTo(Lease::class, 'lease_id');
    }
}
