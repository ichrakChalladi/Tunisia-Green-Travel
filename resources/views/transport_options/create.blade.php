@extends('layouts.appBack')

@section('content')
<style>
    .input-white-gray-border {
        background-color: white;
        border: 1px solid gray;
        padding: 10px;
    }
</style>

<div class="container card col-9 p-3">
    <h3>Create Transport Option</h3>

    <div class="card-body">

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transport-options.store') }}" method="POST">
            @csrf

            <label for="name" class="form-label">
                <i class="fas fa-car"></i> Name
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="text" name="name" class="form-control input-white-gray-border" required>
            </div>

            <label for="disponibilité" class="form-label">
                <i class="fas fa-check-circle"></i> Availability
            </label>
            <div class="mb-3 input-group input-group-outline">
                <select name="disponibilité" class="form-select" required>
                    <option value="disponible">Disponible</option>
                    <option value="non-disponible">Non Disponible</option>
                </select>
            </div>

            <label for="carbon_empreinte" class="form-label">
                <i class="fas fa-leaf"></i> Carbon Footprint
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" step="0.01" name="carbon_empreinte" class="form-control input-white-gray-border" required>
            </div>

            <label for="type" class="form-label">
                <i class="fas fa-bus"></i> Type
            </label>
            <div class="mb-3 input-group input-group-outline">
                <select name="type" class="form-select input-white-gray-border" required>
                    <option value="bus">Bus</option>
                    <option value="train">Train</option>
                    <option value="car">Car</option>
                    <option value="bicycle">Bicycle</option>
                    <option value="airplane">Airplane</option>
                </select>
            </div>

            <label for="description" class="form-label">
                <i class="fas fa-info-circle"></i> Description
            </label>
            <div class="mb-3 input-group input-group-outline">
                <textarea name="description" class="form-control input-white-gray-border" rows="3"></textarea>
            </div>

            <label for="capacity" class="form-label">
                <i class="fas fa-user-friends"></i> Capacity
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" name="capacity" class="form-control input-white-gray-border">
            </div>

            <label for="price_per_km" class="form-label">
                <i class="fas fa-dollar-sign"></i> Price per km
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="number" step="0.01" name="price_per_km" class="form-control input-white-gray-border">
            </div>

            <label for="contact_info" class="form-label">
                <i class="fas fa-phone"></i> Contact Info
            </label>
            <div class="mb-3 input-group input-group-outline">
                <input type="text" name="contact_info" class="form-control input-white-gray-border">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
