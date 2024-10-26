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
       
        <h1><i class="fas fa-campground"></i> Edit a Room</h1>

        <div class="image-container">
            <img src="https://idwey.tn/uploads/0000/44/2021/10/18/242166455-2941288806111530-350299521143869734-n.jpg" alt="Camping Image" class="camping-image">
        </div>

        <div>
            @if($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <p class="hover-paragraph">
            Make changes to the room details below. 
            <i class="fas fa-lightbulb hover-icon" title="Tip"></i>
        </p>

        <form method="post" action="{{ route('room.update', ['room' => $room]) }}">
            @csrf 
            @method('put')

            <div class="form-group">
                <label>Room Name</label>
                <i class="fas fa-door-open icon me-3"></i>
                <input type="text" name="name" placeholder="Room Name" value="{{ $room->name }}" required>
            </div>

            <div class="form-group">
                <label>Room Type</label>
                <i class="fas fa-bed icon me-3"></i>
                <select name="room_type" required>
                    <option value="single" {{ $room->room_type == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="double" {{ $room->room_type == 'double' ? 'selected' : '' }}>Double</option>
                    <option value="suite" {{ $room->room_type == 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label>Price</label>
                <i class="fas fa-dollar-sign icon"></i>
                <input type="text" name="price" placeholder="Price" value="{{ $room->price }}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <i class="fas fa-info-circle icon"></i>
                <input type="text" name="description" placeholder="Description" value="{{ $room->description }}" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <i class="fas fa-flag icon"></i>
                <select name="status" required>
                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="out_of_stock" {{ $room->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="discontinued" {{ $room->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                </select>
            </div>

            <div class="form-group">
                <label>Floor</label>
                <i class="fas fa-arrow-alt-circle-up icon"></i>
                <input type="number" name="floor" placeholder="Floor Number" value="{{ $room->floor }}" required>
            </div>

            <div>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save icon"></i> Update
                </button>
            </div>
        </form>
    </div>
</body>
</html>


@endsection <!-- End the content section -->