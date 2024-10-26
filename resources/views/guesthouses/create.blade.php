@extends('layouts.appBack') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Guesthouse</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #fce4ec;
            /* Light pink background */
            padding: 20px;
        }

        .container {
            max-width: 800px;
            /* Increase container width */
            margin: auto;
            /* Center horizontally */
            padding: 20px;
            background-color: white;
            /* White background for the form */
            border-radius: 8px;
            /* Slightly rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            text-align: center;
            /* Center the text */
        }

        h1 {
            margin-bottom: 20px;
            color: #d81b60;
            /* Darker pink for the header */
        }

        .form-group label {
            font-weight: bold;
            color: #d81b60;
            /* Darker pink for labels */
        }

        .btn-primary {
            background-color: #d81b60;
            /* Pink button */
            border: none;
        }

        .btn-primary:hover {
            background-color: #c2185b;
            /* Darker pink on hover */
        }

        .input-group-text {
            background-color: #f8f9fa;
            /* Light background for icons */
            border: none;
            /* No border for aesthetics */
        }

        .guesthouse-image {
            width: 100%;
            /* Make image responsive */
            height: 300px;
            /* Set a specific height */
            object-fit: cover;
            /* Maintain aspect ratio */
            border-radius: 8px;
            /* Rounded corners */
            margin-bottom: 20px;
            /* Space below the image */
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://demo.discoveryaindraham.com/uploads/0000/6/2023/10/26/2.jpg" alt="Beautiful Guesthouse" class="guesthouse-image">
        <h1>Create a Guesthouse</h1>

        <form method="post" action="{{ route('guesthouse.booking') }}" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                </div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter guesthouse name" value="{{ old('name') }}" required />
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter location" value="{{ old('location') }}" required />
                @error('location')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                </div>
                <input type="number" name="number_of_rooms" id="number_of_rooms" class="form-control @error('number_of_rooms') is-invalid @enderror" placeholder="Enter number of rooms" value="{{ old('number_of_rooms') }}" required />
                @error('number_of_rooms')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                </div>
                <textarea name="booking_policies" id="booking_policies" class="form-control @error('booking_policies') is-invalid @enderror" rows="3" placeholder="Enter booking policies">{{ old('booking_policies') }}</textarea>
                @error('booking_policies')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                </div>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                </div>
                <input id="input-b1" name="input-b1[]" type="file" class="file @error('input-b1') is-invalid @enderror" multiple data-browse-on-zone-click="true">
                @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
        

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Create Guesthouse</button>
            </div>
        </form>
    </div>
</body>

</html>

@endsection <!-- End the content section -->