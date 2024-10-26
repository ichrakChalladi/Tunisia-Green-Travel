@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add Carbon Footprint by Trip</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('carbon-footprint-by-trips.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="transport_option_id">Transport Option</label>
            <select name="transport_option_id" id="transport_option_id" class="form-control" required>
                <option value="">Select Transport Option</option>
                @foreach ($transportOptions as $option)
                    <option value="{{ $option->id }}">{{ $option->name }} ({{ $option->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="starting_point">Starting Point</label>
            <input type="text" name="starting_point" id="starting_point" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" id="destination" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="distance">Distance (km)</label>
            <input type="number" name="distance" id="distance" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="passengers">Number of Passengers</label>
            <input type="number" name="passengers" id="passengers" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Trip</button>
    </form>
</div>
@endsection
