@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Trip</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('carbon-footprint-by-trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="transport_option_id">Transport Option</label>
            <select name="transport_option_id" id="transport_option_id" class="form-control" required>
                @foreach($transportOptions as $option)
                    <option value="{{ $option->id }}" {{ $trip->transport_option_id == $option->id ? 'selected' : '' }}>
                        {{ $option->name }} ({{ $option->type }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="starting_point">Starting Point</label>
            <input type="text" name="starting_point" class="form-control" value="{{ $trip->starting_point }}" required>
        </div>

        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" class="form-control" value="{{ $trip->destination }}" required>
        </div>

        <div class="form-group">
            <label for="distance">Distance (km)</label>
            <input type="number" name="distance" class="form-control" value="{{ $trip->distance }}" required>
        </div>

        <div class="form-group">
            <label for="passengers">Passengers</label>
            <input type="number" name="passengers" class="form-control" value="{{ $trip->passengers }}" required min="1">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $trip->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $trip->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Trip</button>
        <a href="{{ route('carbon-footprint-by-trips.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
