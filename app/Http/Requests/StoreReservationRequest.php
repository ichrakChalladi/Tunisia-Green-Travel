<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true if no authorization logic is needed
    }

    public function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Veuillez sélectionner une chambre.',
            'room_id.exists' => 'La chambre sélectionnée est invalide.',
            'customer_name.required' => 'Le nom du client est requis.',
            'customer_email.required' => 'L\'email du client est requis.',
            'check_in_date.required' => 'La date d\'arrivée est requise.',
            'check_in_date.after_or_equal' => 'La date d\'arrivée doit être aujourd\'hui ou une date ultérieure.',
            'check_out_date.required' => 'La date de départ est requise.',
            'check_out_date.after' => 'La date de départ doit être après la date d\'arrivée.',
            'number_of_guests.required' => 'Le nombre de clients est requis.',
            'number_of_guests.min' => 'Le nombre minimum de clients est 1.',
        ];
    }
}
