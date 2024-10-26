@extends('layouts.app') <!-- Extending the layout file -->

@section('title', 'Rooms for Guesthouse ID: ' . $guesthouseId) <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <img src="https://d3h1lg3ksw6i6b.cloudfront.net/media/image/2022/06/30/1f3d03e2729d47bbaf417a5a99e15ce9_Zannier_Hotels_Sonop__Namib_Desert_Namibia_Tent_Hotel_Glamping_camping__MICHELIN_recom.jpg" alt="Rooms for Guesthouse" class="img-fluid" style="height: 50vh; object-fit: cover;">
        </div>
        <div class="col-4" style="margin-left : -22px;">
            <img src="https://img.freepik.com/premium-photo/glamping-tent-beach-sunrise-sunset-with-beautiful-view-camp-fire-burning_611456-375.jpg" alt="Rooms for Guesthouse" class="img-fluid" style="height: 50vh; object-fit: cover;">
        </div>
        <div class="col-4">
            <img src="https://img.freepik.com/premium-photo/glamping-tent-beach-sunrise-sunset-with-beautiful-view-camp-fire-burning_611456-378.jpg" alt="Rooms for Guesthouse" class="img-fluid" style="height: 50vh; object-fit: cover;">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            <h3>Available rooms for this Guesthouse :</h3>
        </div>
        <p class="col-12 d-flex justify-content-center">Here is the list of all rooms associated with this guesthouse.</p>
    </div>

    <div class="row mt-2">
        @forelse($rooms as $room)
        @if($room->status === 'available')
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text"><strong>Room Type:</strong> {{ $room->room_type }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>

                    @if($room->status === 'available')
                    <p class="card-text"><strong>Status:</strong> <span class="text-success">Available</span></p>
                    @else
                    <p class="card-text"><strong>Status:</strong> <strong class="text-danger">{{ $room->status }}</strong></p>
                    @endif

                    <p class="card-text"><strong>Floor:</strong> {{ $room->floor }}</p>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <a class="btn btn-outline-primary btn-sm ms-3 d-flex align-items-center" href="{{ route('reservations.create', ['room_id' => $room->id]) }}">Reserve this room</a>
                    
                </div>
            </div>
        </div>
        @endif
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center text-light"><b>No rooms found for this guesthouse.</b></div>
        </div>
        @endforelse

    </div>
</div>

@endsection <!-- End the content section -->