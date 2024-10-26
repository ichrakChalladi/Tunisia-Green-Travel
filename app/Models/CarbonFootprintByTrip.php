<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarbonFootprintByTrip extends Model
{
    use HasFactory;
 // Define the fillable fields for mass assignment
    protected $fillable = [
        'transport_option_id',
        'starting_point',
        'destination',
        'distance',
        'passengers',
        'start_date',
        'end_date',
        'calculated_carbon_footprint',
        'trip_price',
    ];

    // Define the relationship with the TransportOption model
    public function transportOption()
    {
        return $this->belongsTo(TransportOption::class);
    }
}
