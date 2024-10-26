@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Carbon Footprint by Trip List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton pour ajouter un nouveau trip -->
    <div class="mb-3">
        <a href="{{ route('carbon-footprint-by-trips.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Trip
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><i class="fas fa-car"></i> Transport Option</th>
                <th><i class="fas fa-map-marker-alt"></i> Starting Point</th>
                <th><i class="fas fa-map-marker"></i> Destination</th>
                <th><i class="fas fa-road"></i> Distance (km)</th>
                <th><i class="fas fa-users"></i> Passengers</th>
                <th><i class="fas fa-calendar-alt"></i> Start Date</th>
                <th><i class="fas fa-calendar-check"></i> End Date</th>
                <th><i class="fas fa-leaf"></i> Carbon Footprint</th>
                <th><i class="fas fa-dollar-sign"></i> Trip Price</th>
                <th><i class="fas fa-cogs"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carbonFootprintByTrips as $trip)
                <tr>
                    <td class="text-center"><i class="fas fa-car"></i> {{ $trip->transportOption->name }} ({{ $trip->transportOption->type }})</td>
                    <td class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $trip->starting_point }}</td>
                    <td class="text-center"><i class="fas fa-map-marker"></i> {{ $trip->destination }}</td>
                    <td class="text-center"><i class="fas fa-road"></i> {{ $trip->distance }} km</td>
                    <td class="text-center"><i class="fas fa-users"></i> {{ $trip->passengers }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i> {{ $trip->start_date }}</td>
                    <td class="text-center"><i class="fas fa-calendar-check"></i> {{ $trip->end_date }}</td>
                    <td class="text-center"><i class="fas fa-leaf"></i> {{ $trip->calculated_carbon_footprint }} kg CO2</td>
                    <td class="text-center"><i class="fas fa-dollar-sign"></i> ${{ $trip->trip_price }}</td>
                    <td class="text-center">
                        <a href="{{ route('carbon-footprint-by-trips.show', $trip->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                        <a href="{{ route('carbon-footprint-by-trips.edit', $trip->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('carbon-footprint-by-trips.destroy', $trip->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No trips found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
