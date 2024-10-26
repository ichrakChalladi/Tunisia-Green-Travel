<?php

namespace App\Http\Controllers;

use App\Models\Guesthouse;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($guesthouseId)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $rooms = Room::where('guesthouse_id', $guesthouseId)->get();
            return view('rooms.index', compact('rooms', 'guesthouseId'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function show()
    {
        $rooms = Room::all();
        return view('rooms.show', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($guesthouseId)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            return view('rooms.create', ['guesthouseId' => $guesthouseId]);
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function booking(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'room_type' => 'nullable|string|max:50',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'status' => 'nullable|string|in:available,out_of_stock,discontinued',
                'floor' => 'nullable|integer|min:1',
                'guesthouse_id' => 'required|integer|exists:guesthouses,id', // Ensure guesthouse_id is passed
            ]);

            $room = new Room();
            $room->name = $request->name;
            $room->room_type = $request->room_type;
            $room->price = $request->price;
            $room->description = $request->description;
            $room->status = $request->status;
            $room->floor = $request->floor;
            $room->guesthouse_id = $request->guesthouse_id; // Store the guesthouse ID
            $room->save();

            // Redirect back with success message
            return redirect()->route('room.index', ['guesthouseId' => $request->guesthouse_id])->with('success', 'Room created successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }



    public function edit(Room $room)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            return view('rooms.edit', ['room' => $room]);
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Room $room, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:available,out_of_stock,discontinued',
            'floor' => 'required|integer|min:1',
        ]);

        $room->update($data);

        // Retrieve the guesthouseId from the room
        $guesthouseId = $room->guesthouse_id;

        // Redirect back to the room index with the guesthouseId
        return redirect(route('room.index', ['guesthouseId' => $guesthouseId]))->with('success', 'Room Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $guesthouseId = $room->guesthouse_id; // Retrieve guesthouseId from the room
        $room->delete();

        // Redirect back to the room index with the guesthouseId
        return redirect(route('room.index', ['guesthouseId' => $guesthouseId]))->with('success', 'Room deleted successfully');
    }
    public function listRoom($guesthouseId)
    {
        $rooms = Room::where('guesthouse_id', $guesthouseId)->get(); // Fetch rooms for the specified guesthouse
        return view('rooms.list', compact('rooms', 'guesthouseId')); // Return the view with rooms data
    }
}
