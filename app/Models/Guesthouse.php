<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guesthouse extends Model
{
    use HasFactory;


    protected $fillable = [

        'user_id',
        'name',
        'location',
        'number_of_rooms',
        'booking_policies',
        'description',
        'images'
    ];


    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'guesthouse_id');
    }
}
