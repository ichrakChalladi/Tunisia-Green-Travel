<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Review extends Model
{
    use HasFactory;

    // Specify fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'guesthouse_id',
        'rating',
        'title',
        'content',
        'images',
        'status'
    ];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the guesthouse that the review is about.
     */
    public function guesthouse()
    {
        return $this->belongsTo(Guesthouse::class);
    }
}

