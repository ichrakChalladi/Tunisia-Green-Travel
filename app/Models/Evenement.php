<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Evenement extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin', 'lieu_id'];

    public function lieu()
    {
        return $this->belongsTo(Lieu::class);
    }

}
