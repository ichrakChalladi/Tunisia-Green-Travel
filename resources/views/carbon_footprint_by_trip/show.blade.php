@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Trip Details</h1>

    <div class="card">
        


        <div class="card-body">
            <h5 class="card-title">Transport Option: {{ $trip->transportOption->name }} ({{ $trip->transportOption->type }})</h5>
            <p class="card-text"><strong>Starting Point:</strong> {{ $trip->starting_point }}</p>
            <p class="card-text"><strong>Destination:</strong> {{ $trip->destination }}</p>
            <p class="card-text"><strong>Distance:</strong> {{ $trip->distance }} km</p>
            <p class="card-text"><strong>Passengers:</strong> {{ $trip->passengers }}</p>
            <p class="card-text"><strong>Start Date:</strong> {{ $trip->start_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $trip->end_date }}</p>
            <p class="card-text"><strong>Carbon Footprint:</strong> {{ $trip->calculated_carbon_footprint }} kg CO2</p>
            <p class="card-text"><strong>Trip Price:</strong> ${{ $trip->trip_price }}</p>
            <a href="{{ route('carbon-footprint-by-trip.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
