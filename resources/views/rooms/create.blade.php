<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.appBack') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Room</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #fce4ec; /* Light pink background */
            padding: 20px;
        }
        .container {
            max-width: 800px; /* Increase container width */
            margin: auto; /* Center horizontally */
            padding: 20px;
            background-color: white; /* White background for the form */
            border-radius: 8px; /* Slightly rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            text-align: center; /* Center the text */
            animation: fadeIn 0.5s; /* Fade-in animation */
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .icon-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-around; /* Space between icons */
            margin-bottom: 20px; /* Space below icons */
        }
        .icon {
            font-size: 50px; /* Size of the icons */
            color: #d81b60; /* Icon color */
            transition: transform 0.3s; /* Animation for icons */
        }
        .icon:hover {
            transform: scale(1.2); /* Scale up on hover */
        }
        h1 {
            margin-bottom: 20px;
            color: #d81b60; /* Darker pink for the header */
        }
        .form-group label {
            font-weight: bold;
            color: #d81b60; /* Darker pink for labels */
        }
        .btn-primary {
            background-color: #d81b60; /* Pink button */
            border: none;
            transition: background-color 0.3s; /* Smooth transition */
        }
        .btn-primary:hover {
            background-color: #c2185b; /* Darker pink on hover */
        }
        .alert {
            margin-bottom: 20px;
        }
        .input-group-text {
            background-color: #f8f9fa; /* Light background for icons */
            border: none; /* No border for aesthetics */
        }
        .camping-image {
            width: 100%; /* Make image responsive */
            height: 200px; /* Set a specific height */
            object-fit: cover; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners */
            margin-bottom: 20px; /* Space below the main image */
            transition: transform 0.3s; /* Transition effect */
        }
        .camping-image:hover {
            transform: scale(1.05); /* Zoom effect on hover */
        }
        .hover-paragraph {
            color: #333; /* Default color */
            transition: color 0.3s ease; /* Smooth transition for color change */
            display: inline-block; /* Allow hover effect */
        }
        .hover-paragraph:hover {
            color: #d81b60; /* Change to lighter pink on hover */
        }
        .hover-icon {
            font-size: 20px; /* Size of the icon */
            color: #d81b60; /* Color of the icon */
            margin-left: 5px; /* Space between text and icon */
            vertical-align: middle; /* Align with text */
            transition: color 0.3s ease; /* Smooth transition for hover */
        }
        .hover-paragraph:hover .hover-icon {
            color: #c2185b; /* Change color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-container">
            <i class="fas fa-campground icon" title="Camping"></i>
            <i class="fas fa-bed icon" title="Booking Room"></i>
            <i class="fas fa-concierge-bell icon" title="Concierge"></i>
            <i class="fas fa-utensils icon" title="Dining"></i>
        </div>

        <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0" alt="Camping" class="camping-image">
        <h1>Create a Room</h1>

   
        <p class="hover-paragraph">
            Manage all hotel rooms here. Create, edit, or delete rooms easily. Ensure a seamless booking experience for guests.
            <i class="fas fa-lightbulb hover-icon" title="Tip"></i>
        </p>

        <form method="post" action="{{ route('room.booking') }}">
            @csrf 
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                </div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter room name" value="{{ old('name') }}" required />
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-bed"></i></span>
                </div>
                <select name="room_type" id="room_type" class="form-control @error('room_type') is-invalid @enderror" required>
                    <option value="single" {{ old('room_type') == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="double" {{ old('room_type') == 'double' ? 'selected' : '' }}>Double</option>
                    <option value="suite" {{ old('room_type') == 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
                @error('room_type')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price" step="0.01" value="{{ old('price') }}" required />
                @error('price')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter room description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                </div>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                </select>
                @error('status')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                </div>
                <input type="number" name="floor" id="floor" class="form-control @error('floor') is-invalid @enderror" placeholder="Enter floor number" value="{{ old('floor') }}" required />
                @error('floor')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="hidden" name="guesthouse_id" value="{{ $guesthouseId }}" />
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Create Room</button>
            </div>
        </form>
    </div>
</body>
</html>

@endsection <!-- End the content section -->
