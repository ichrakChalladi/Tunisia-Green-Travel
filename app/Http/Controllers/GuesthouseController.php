<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guesthouse;
use App\Models\Review;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuesthouseController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

        $guesthouses = Guesthouse::all();

        foreach ($guesthouses as $guesthouse) {
            $blogList = Review::where('guesthouse_id', $guesthouse->id)->get();
            $averageRating = $blogList->avg('rating');
            $guesthouse->averageRating = 5;
        }

        return view('guesthouses.index', ['guesthouses' => $guesthouses ]);
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        return view('guesthouses.create');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function edit(Guesthouse $guesthouse)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        return view('guesthouses.edit', ['guesthouse' => $guesthouse]);
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function destroy(Guesthouse $guesthouse)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        $guesthouse->delete();
        return redirect(route('guesthouse.index'))->with('success', 'Guesthouse deleted Succesffully');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function update(Guesthouse $guesthouse, Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'number_of_rooms' => 'required|integer|min:1',
            'booking_policies' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $guesthouse->update($data);

        return redirect(route('guesthouse.index'))->with('success', 'Guesthouse Updated Successfully');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

    }

    public function booking(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'number_of_rooms' => 'required|integer|min:1',
            'booking_policies' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Create a new Guesthouse entity
        $newGuesthouse = new Guesthouse();
        $newGuesthouse->name = $data['name'];
        $newGuesthouse->location = $data['location'];
        $newGuesthouse->number_of_rooms = $data['number_of_rooms'];
        $newGuesthouse->booking_policies = $data['booking_policies'];
        $newGuesthouse->description = $data['description'];
        $newGuesthouse->user_id = Auth::user()->id;

        // Handle file uploads if any
        if ($request->hasFile('input-b1')) {
            $images = [];
            foreach ($request->file('input-b1') as $image) {
                // Store the image in the public/images directory
                $path = $image->store('images', 'public');

                // Generate the URL for the image
                $imageUrl = Storage::url($path);
                $images[] = $imageUrl; // Add the image URL to the array
            }
            $newGuesthouse->images = json_encode($images); // Save image URLs as JSON
        }

        $newGuesthouse->save();
        return redirect(route('guesthouse.index'))->with('success', 'Guesthouse created successfully!');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function listGuesthouses()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $guesthouses = Guesthouse::all(); // Fetch all guesthouses
        return view('guesthouses.list_guesthouse', compact('guesthouses'));

        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
}
