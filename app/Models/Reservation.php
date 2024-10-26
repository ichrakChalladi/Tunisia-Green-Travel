<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'customer_name',
        'customer_email',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
