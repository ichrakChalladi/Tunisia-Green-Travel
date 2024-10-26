<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportOption extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'disponibilité',
    'carbon_empreinte',
    'type',
    'description',
    'capacity',
    'price_per_km',
    'contact_info',
];

public function carbonFootprintByTrips()
{
    return $this->hasMany(CarbonFootprintByTrip::class);
}

}
