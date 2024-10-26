<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $reservations = Reservation::with('room')->get();
        return view('reservations.index', compact('reservations'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function backView()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        $reservations = Reservation::all();
        return view('reservations.reservationBack', compact('reservations'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
        // Check if a room ID is provided in the request
        $selectedRoom = null;
        if ($request->has('room_id')) {
            $selectedRoom = Room::find($request->input('room_id'));
        }

        // Get all rooms for the dropdown
        $rooms = Room::all();

        // Pass both the selected room and the list of rooms to the view
        return view('reservations.create', [
            'selectedRoom' => $selectedRoom,
            'rooms' => $rooms
        ]);
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function store(StoreReservationRequest $request)
    {
        if (Auth::check()) {
        // Create a new reservation with the validated data
        Reservation::create($request->validated());

        // Redirect with a success message
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    // Show the form for editing the specified reservation
    public function edit(Reservation $reservation)
    {
        if (Auth::check()) {
        $rooms = Room::all(); // Get all rooms to allow room selection if needed
        return view('reservations.edit', compact('reservation', 'rooms'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    // Update the specified reservation in the database
    public function update(Request $request, Reservation $reservation)
    {
        if (Auth::check()) {
        // Validate the request
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
        ]);

        // Update the reservation with validated data
        $reservation->update($validated);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function destroy(Reservation $reservation)
    {
        if (Auth::check()) {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
}
