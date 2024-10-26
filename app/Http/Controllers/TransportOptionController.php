<?php

namespace App\Http\Controllers;

use App\Models\TransportOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $transportOptions = TransportOption::all();
            return view('transport_options.index', compact('transportOptions'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('transport_options.create');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'disponibilité' => 'required|in:disponible,non-disponible',
                'carbon_empreinte' => 'required|numeric|min:0', // Ensure carbon footprint is non-negative
                'type' => 'required|in:bus,train,car,bicycle,airplane',
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer|min:1', // Capacity must be a positive integer if provided
                'price_per_km' => 'nullable|numeric|min:0', // Price must be non-negative if provided
                'contact_info' => 'nullable|string',
            ]);

            TransportOption::create($request->only([
                'name',
                'disponibilité',
                'carbon_empreinte',
                'type',
                'description',
                'capacity',
                'price_per_km',
                'contact_info',
            ]));

            return redirect()->route('transport-options.index')->with('success', 'Transport option created successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportOption $transportOption)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('transport_options.show', compact('transportOption'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransportOption $transportOption)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('transport_options.edit', compact('transportOption'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportOption $transportOption)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'disponibilité' => 'required|in:disponible,non-disponible',
                'carbon_empreinte' => 'required|numeric|min:0', // Ensure carbon footprint is non-negative
                'type' => 'required|in:bus,train,car,bicycle,airplane',
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer|min:1', // Capacity must be a positive integer if provided
                'price_per_km' => 'nullable|numeric|min:0', // Price must be non-negative if provided
                'contact_info' => 'nullable|string',
            ]);

            $transportOption->update($request->only([
                'name',
                'disponibilité',
                'carbon_empreinte',
                'type',
                'description',
                'capacity',
                'price_per_km',
                'contact_info',
            ]));

            return redirect()->route('transport-options.index')->with('success', 'Transport option updated successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function destroy(TransportOption $transportOption)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $transportOption->delete();
            return redirect()->route('transport-options.index')->with('success', 'Transport option deleted successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
}
