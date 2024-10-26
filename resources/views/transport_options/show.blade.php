@extends('layouts.appBack')

@section('content')
    <div class="container">
        <h1>Transport Option Details</h1>
        <p><strong>Name:</strong> {{ $transportOption->name }}</p>
        <p><strong>Availability:</strong> {{ $transportOption->disponibilité }}</p>
        <p><strong>Carbon Footprint:</strong> {{ $transportOption->carbon_empreinte }}</p>
        <p><strong>Type:</strong> {{ $transportOption->type }}</p>
        <p><strong>Description:</strong> {{ $transportOption->description }}</p>
        <p><strong>Capacity:</strong> {{ $transportOption->capacity }}</p>
        <p><strong>Price per km:</strong> {{ $transportOption->price_per_km }}</p>
        <p><strong>Contact Info:</strong> {{ $transportOption->contact_info }}</p>
        
        <a href="{{ route('transport-options.index') }}" class="btn btn-primary">Back to List</a>
        <a href="{{ route('transport-options.edit', $transportOption) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('transport-options.destroy', $transportOption) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transport option?');">Delete</button>
        </form>
    </div>
@endsection
