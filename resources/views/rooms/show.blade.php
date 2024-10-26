<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<style>
    .custom-underline {
        text-decoration: none; /* Remove the default underline */
        position: relative;
        color: #0a95f2!important;
    }

    .custom-underline::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -1px; /* Adjust the distance from the text */
        width: 100%;
        height: 1px; /* Height of the underline */
        box-shadow: 0px 2px 0px black; /* Optional: adds shadow effect */
        color: #0a95f2!important;
    }
</style>





<div class="col-12 mt-2">
    <div class="mb-5 ps-3">
        <h6 class="mb-1">Rooms</h6>
        <p class="text-sm">welcome to our Guesthouse</p>
    </div>
    <div class="row ">
        
        @foreach($rooms as $room)
        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 mt-3">
            <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{ Vite::asset('resources/assets/img/home-decor-1.jpg') }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </a>
                </div>

                
                <div class="row">
                    <div class="card-body p-3">
                        <p class="mb-0 text-sm">{{ $room->price }} $</p>
                        <a href="javascript:;">
                            <h5>
                            {{$room ->name}} ({{ $room->room_type }})
                            </h5>
                        </a>
                        <p class="mb-4 text-sm">
                        {{ $room->description }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">Réserver</button>
                            <div class="avatar-group mt-2 text-primary">
                               <a href="{{ route('blog.blogDisplay', $room->id) }}" class="custom-underline">Voir les avis</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>




@endsection