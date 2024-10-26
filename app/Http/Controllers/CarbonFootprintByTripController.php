<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarbonFootprintByTrip; 
use App\Models\TransportOption; 
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class CarbonFootprintByTripController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $transportOptions = TransportOption::all();
        return view('carbon_footprint_by_trip.create', compact('transportOptions'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    // Store a new Carbon Footprint By Trip
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $request->validate([
            'transport_option_id' => 'required|exists:transport_options,id',
            'starting_point' => 'required|string',
            'destination' => 'required|string',
            'distance' => 'required|numeric',
            'passengers' => 'required|integer|min:1|max:' . TransportOption::find($request->transport_option_id)->capacity,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate the carbon footprint and trip price
        $transportOption = TransportOption::find($request->transport_option_id);
        $carbonFootprint = $request->distance * $transportOption->carbon_empreinte;
        $tripPrice = $request->distance * $transportOption->price_per_km;

        // Create the Carbon Footprint By Trip entry
        CarbonFootprintByTrip::create([
            'transport_option_id' => $request->transport_option_id,
            'starting_point' => $request->starting_point,
            'destination' => $request->destination,
            'distance' => $request->distance,
            'passengers' => $request->passengers,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'calculated_carbon_footprint' => $carbonFootprint,
            'trip_price' => $tripPrice,
        ]);

        return redirect()->route('carbon-footprint-by-trip.index')->with('success', 'Carbon Footprint By Trip created successfully.');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function show($id)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $trip = CarbonFootprintByTrip::with('transportOption')->findOrFail($id);
        return view('carbon_footprint_by_trip.show', compact('trip'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function edit($id)
    {   
        if (Auth::check() && Auth::user()->role === 'user') {
        $trip = CarbonFootprintByTrip::with('transportOption')->findOrFail($id);
        $transportOptions = TransportOption::all(); 
        return view('carbon_footprint_by_trip.edit', compact('trip', 'transportOptions'));

        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
    public function destroy($id)
{
    if (Auth::check() && Auth::user()->role === 'user') {
    // Find the trip by ID or fail
    $trip = CarbonFootprintByTrip::findOrFail($id);
    
    // Delete the trip
    $trip->delete();

    return redirect()->route('carbon-footprint-by-trip.index')->with('success', 'Trip deleted successfully.');
    }
    else {
        return redirect()->route('login')->with('error', 'Access denied.');
    }
}



    // Display a list of all Carbon Footprint By Trips
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $carbonFootprintByTrips = CarbonFootprintByTrip::with('transportOption')->get();
        return view('carbon_footprint_by_trip.index', compact('carbonFootprintByTrips'));
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    // Update an existing Carbon Footprint By Trip
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
        $trip = CarbonFootprintByTrip::findOrFail($id);

        $request->validate([
            'transport_option_id' => 'required|exists:transport_options,id',
            'starting_point' => 'required|string',
            'destination' => 'required|string',
            'distance' => 'required|numeric',
            'passengers' => 'required|integer|min:1|max:' . TransportOption::find($request->transport_option_id)->capacity,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate the carbon footprint and trip price
        $transportOption = TransportOption::find($request->transport_option_id);
        $carbonFootprint = $request->distance * $transportOption->carbon_empreinte;
        $tripPrice = $request->distance * $transportOption->price_per_km;

        // Update the Carbon Footprint By Trip entry
        $trip->update([
            'transport_option_id' => $request->transport_option_id,
            'starting_point' => $request->starting_point,
            'destination' => $request->destination,
            'distance' => $request->distance,
            'passengers' => $request->passengers,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'calculated_carbon_footprint' => $carbonFootprint,
            'trip_price' => $tripPrice,
        ]);

        return redirect()->route('carbon-footprint-by-trip.index')->with('success', 'Carbon Footprint By Trip updated successfully.');
        }
        else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
}
