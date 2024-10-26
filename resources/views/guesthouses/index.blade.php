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
    <title>Guesthouses</title>
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
            width: 80%;
            /* Set a smaller width for the image */
            height: auto;
            /* Maintain aspect ratio */
            max-width: 600px;
            /* Set a max width */
            border-radius: 8px;
            /* Rounded corners */
            margin-bottom: 20px;
            /* Space below the image */
            transition: box-shadow 0.3s ease;
            /* Smooth transition for shadow */
        }

        .guesthouse-image:hover {
            box-shadow: 0 0 20px rgba(216, 27, 96, 0.8);
            /* Glowing effect */
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/385233634.jpg?k=ebe8ca1b65cba29585ea2991ac7ad1e59d538afaf780c74a4254fd0ed1d4d68e&o=&hp=1" alt="Bambu Guest House" class="guesthouse-image">

        <h1>Guesthouses</h1>
        <p>Manage all guesthouses here. Create, edit, or delete guesthouses easily. Ensure a seamless booking experience for guests.</p>

        <!-- Add Guesthouse button -->
        <div>
            <a href="{{ route('guesthouse.create') }}" class="add-btn">
                <i class="fas fa-plus"></i> Add Guesthouse
            </a>
        </div>

        <table>
            <tr>
                <th><i class="fas fa-id-badge"></i>ID</th>
                <th><i class="fas fa-home"></i>Name</th>
                <th><i class="fas fa-map-marker-alt"></i>Location</th>
                <th><i class="fas fa-bed"></i>Number of Rooms</th>
                <th><i class="fas fa-file-alt"></i>Booking Policies</th>
                <th><i class="fas fa-file-alt"></i>Description</th>

                <th><i class="fas fa-cogs"></i>Actions</th>
            </tr>



            @foreach($guesthouses as $guesthouse)
            <tr>
                <td>
                    @foreach (json_decode($guesthouse->images, true) as $image)
                    <a href="javascript:void(0);" class="avatar-md">
                        <div class="avatar-title bg-light rounded">
                            <img src="{{ asset($image) }}" alt="Product Image" class="product-img" width="90px">
                        </div>
                    </a>
                    @endforeach
                </td>
                <td>{{ $guesthouse->name }}</td>
                <td>{{ $guesthouse->location }}</td>
                <td>{{ $guesthouse->number_of_rooms }}</td>

                <td>{{ $guesthouse->booking_policies }}</td>

                <td>{{ $guesthouse->description }}</td>
                <td>

                    <a href="{{ route('blog.blogDisplay', ['guesthouseId' => $guesthouse -> id]) }}" class="edit-btn mb-1">
                        <i class="fas fa-star"></i>
                    </a>

                    <a href="{{ route('room.index', ['guesthouseId' => $guesthouse->id]) }}" class="edit-btn mb-1">
                        <i class="fas fa-bed"></i>
                    </a>

                    <a href="{{ route('guesthouse.edit', ['guesthouse' => $guesthouse]) }}" class="edit-btn">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="post" action="{{ route('guesthouse.destroy', ['guesthouse' => $guesthouse]) }}" style="display:inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>


@endsection <!-- End the content section -->