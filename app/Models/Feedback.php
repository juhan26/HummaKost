<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = "feedbacks"; 
    protected $fillable = ['message', 'rating', 'user_id', 'user_name', 'user_image'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
    