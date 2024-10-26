@extends('layouts.app') <!-- Extending the layout file -->

@section('title', 'Guesthouses List') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<div class="container-fluid">

    <div class="container mt-4">
        <div class="mb-4 text-center" style="background-color: #ff69b4; padding: 20px; border-radius: 8px; animation: fadeIn 0.5s;">
            <h1 style="color: white;"><i class="fas fa-home"></i> Guesthouses <i class="fas fa-bed"></i></h1>
            <p style="color: white;">Here is the list of all guesthouses. You can manage them easily.</p>
        </div>

        <div class="row">
            @foreach($guesthouses as $guesthouse)
            <div class="col-md-4 mb-4">
                <div class="card" style="transition: transform 0.3s;">


                    @foreach (json_decode($guesthouse->images, true) as $image)
                    <img class="card-img-top" src="{{ asset($image) }}" alt="{{ $guesthouse->name }}" width="50px">
                    @endforeach


                    <div class="card-body">
                        <h5 class="card-title">{{ $guesthouse->name }}</h5>
                        <p class="card-text">{{ $guesthouse->description }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $guesthouse->location }}</p>
                        <p class="card-text"><strong>Rooms:</strong> {{ $guesthouse->number_of_rooms }}</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('listRoom', ['guesthouseId' => $guesthouse->id]) }}" class="btn btn-outline-primary btn-sm">View Rooms</a>
                            <div class="avatar-group mt-2">
                                <a href="{{ route('blog.blogDisplay', ['guesthouseId' => $guesthouse -> id]) }}" class="edit-btn mb-1">
                                    <i class="fas fa-star"></i> {{ number_format($guesthouse->reviews_avg_rating, 2) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .card:hover {
        transform: scale(1.05);
        /* Scale up on hover */
    }
</style>

@endsection <!-- End the content section -->