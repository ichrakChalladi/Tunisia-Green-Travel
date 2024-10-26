<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.appBack') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #fce4ec;
            /* Light pink background */
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            /* Increase container width */
            margin: auto;
            /* Center horizontally */
            padding: 30px;
            /* Increase padding for better spacing */
            background-color: white;
            /* White background for the form */
            border-radius: 8px;
            /* Slightly rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            text-align: center;
            /* Center the text */
        }

        h1 {
            margin-bottom: 20px;
            color: #d81b60;
            /* Darker pink for the header */
        }

        p {
            color: #333;
            margin-bottom: 20px;
            transition: color 0.3s ease;
            /* Smooth transition for color change */
        }

        p:hover {
            color: #d81b60;
            /* Change to a lighter pink on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            /* White background color for table */
            border-radius: 10px;
        }

        th,
        td {
            border: 1px solid #d81b60;
            /* Pink border color */
            padding: 10px;
            text-align: center;
            /* Center the text in table cells */
        }

        th {
            background-color: #f8d3e0;
            /* Pink background color for table header */
            color: #d81b60;
            /* Consistent text color for header */
        }

        tr:nth-child(even) {
            background-color: #fce4ec;
            /* Light pink background color for even rows */
        }

        tr:nth-child(odd) {
            background-color: #f9e7e2;
            /* Light pink background color for odd rows */
        }

        .edit-btn,
        .delete-btn,
        .add-btn {
            padding: 5px 10px;
            margin: 0 10px;
            /* More space between buttons */
            background-color: #d81b60;
            /* Pink background color for buttons */
            color: #fff;
            /* White text color for buttons */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .edit-btn:hover,
        .delete-btn:hover,
        .add-btn:hover {
            background-color: #c2185b;
            /* Darker pink background color on hover */
        }

        .guesthouse-image {
            width: 50%; /* Set a smaller width for the image */
            height: 410px; /* Maintain aspect ratio */
            max-width: 600px; /* Set a max width */
            border-radius: 8px; /* Rounded corners */
            margin-bottom: 20px; /* Space below the image */
            transition: box-shadow 0.3s ease; /* Smooth transition for shadow */
        }

        .guesthouse-image:hover {
            box-shadow: 0 0 20px rgba(216, 27, 96, 0.8);
            /* Glowing effect */
        }

        .camping-icon {
            font-size: 30px;
            /* Size of camping icons */
            margin: 5px;
            /* Space around icons */
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <i class="fas fa-campground camping-icon"></i>
            <i class="fas fa-tree camping-icon"></i>
            <i class="fas fa-fire camping-icon"></i>
            <i class="fas fa-mountain camping-icon"></i>
        </div>
        <img src="https://demo.discoveryaindraham.com/uploads/0000/6/2023/10/26/image.jpg" alt="Rooms" class="guesthouse-image">

        <h1>Rooms</h1>
        <p class="hover-paragraph">Manage all hotel rooms here. Create, edit, or delete rooms easily. Ensure a seamless booking experience for guests.</p>

        <!-- Add Room button -->
        <div>
            <a href="{{ route('room.create', ['guesthouseId' => $guesthouseId]) }}" class="add-btn">
                <i class="fas fa-plus"></i> Add Room
            </a>
        </div>

        <table>
            <tr>
                <th><i class="fas fa-id-card"></i> ID</th>
                <th><i class="fas fa-sign"></i> Name</th>
                <th><i class="fas fa-door-open"></i> Room Type</th>
                <th><i class="fas fa-dollar-sign"></i> Price</th>
                <th><i class="fas fa-file-alt"></i> Description</th>
                <th><i class="fas fa-check-circle"></i> Status</th>
                <th><i class="fas fa-building"></i> Floor</th>
                <th><i class="fas fa-edit"></i> Edit</th>
                <th><i class="fas fa-trash-alt"></i> Delete</th>
            </tr>

            
            @foreach($rooms as $room)
            <tr>
                <td><i class="fas fa-id-card"></i> {{ $room->id }}</td>
                <td><i class="fas fa-sign"></i> {{ $room->name }}</td>
                <td><i class="fas fa-door-open"></i> {{ $room->room_type }}</td>
                <td><i class="fas fa-dollar-sign"></i> {{ $room->price }}</td>
                <td><i class="fas fa-file-alt"></i> {{ $room->description }}</td>
                <td><i class="fas fa-check-circle"></i> {{ $room->status }}</td>
                <td><i class="fas fa-building"></i> {{ $room->floor }}</td>
                <td>
                    <a href="{{ route('room.edit', ['room' => $room]) }}" class="edit-btn">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('room.destroy', ['room' => $room]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-btn">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
                <td>
                    @if($room->status === 'available')
                    <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="reserve-btn">
                        <i class="fas fa-calendar-check"></i> Reserve
                    </a>
                    @else
                    <span class="badge badge-danger">Not Available</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>


@endsection <!-- End the content section -->