@extends('layouts.appBack')

@section('content')
<style>
    .input-white-gray-border {
        background-color: white;
        border: 1px solid gray;
        padding: 10px;
        /* Adjust padding as needed */
    }
</style>

<div class="container card col-9 p-3">
    <h3>Edit Transport Option</h3>

    <div class="card-body">
        <form action="{{ route('transport-options.update', $transportOption) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name" class="form-label">
                <i class="fas fa-car"></i> Name
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="text" name="name" id="name" class="form-control input-white-gray-border" value="{{ $transportOption->name }}" required>
            </div>

            <label for="disponibilité" class="form-label">
                <i class="fas fa-check-circle"></i> Availability
            </label>
            <div class="mb-3 input-group input-group-outline">
                <select name="disponibilité" id="disponibilité" class="form-select input-white-gray-border" required>
                    <option value="disponible" {{ $transportOption->disponibilité == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="non-disponible" {{ $transportOption->disponibilité == 'non-disponible' ? 'selected' : '' }}>Non Disponible</option>
                </select>
            </div>

            <label for="carbon_empreinte" class="form-label">
                <i class="fas fa-leaf"></i> Carbon Footprint
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" name="carbon_empreinte" id="carbon_empreinte" class="form-control input-white-gray-border" step="0.01" value="{{ $transportOption->carbon_empreinte }}" required>
            </div>

            <label for="type" class="form-label">
                <i class="fas fa-bus"></i> Type
            </label>
            <div class="mb-3 input-group input-group-outline">
                <select name="type" id="type" class="form-select input-white-gray-border" required>
                    <option value="bus" {{ $transportOption->type == 'bus' ? 'selected' : '' }}>Bus</option>
                    <option value="train" {{ $transportOption->type == 'train' ? 'selected' : '' }}>Train</option>
                    <option value="car" {{ $transportOption->type == 'car' ? 'selected' : '' }}>Car</option>
                    <option value="bicycle" {{ $transportOption->type == 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                    <option value="airplane" {{ $transportOption->type == 'airplane' ? 'selected' : '' }}>Airplane</option>
                </select>
            </div>

            <label for="description" class="form-label">
                <i class="fas fa-info-circle"></i> Description
            </label>
            <div class="mb-3 input-group input-group-outline">
                <textarea name="description" id="description" class="form-control input-white-gray-border">{{ $transportOption->description }}</textarea>
            </div>

            <label for="capacity" class="form-label">
                <i class="fas fa-user-friends"></i> Capacity
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" name="capacity" id="capacity" class="form-control input-white-gray-border" value="{{ $transportOption->capacity }}">
            </div>

            <label for="price_per_km" class="form-label">
                <i class="fas fa-dollar-sign"></i> Price per km
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" name="price_per_km" id="price_per_km" class="form-control input-white-gray-border" step="0.01" value="{{ $transportOption->price_per_km }}">
            </div>

            <label for="contact_info" class="form-label">
                <i class="fas fa-phone"></i> Contact Info
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="text" name="contact_info" id="contact_info" class="form-control input-white-gray-border" value="{{ $transportOption->contact_info }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Transport Option</button>
        </form>
    </div>
</div>
@endsection
