@extends('layouts.appBack') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-primary border-radius-lg pt-3 pb-2">
                        <h6 class="text-white text-capitalize ps-3">Reservations</h6> <!-- Updated title -->
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Check-in Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Check-out Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number of Guests</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation) <!-- Updated from $reviews to $reservations -->
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ Vite::asset('resources/assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $reservation->customer_name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->customer_email }}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->check_in_date->format('Y-m-d') }}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->check_out_date->format('Y-m-d') }}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->number_of_guests }}</p>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @if($reservation->status)
                                        <span class="badge badge-sm bg-gradient-success">Confirmed</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">Pending</span>
                                        @endif
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $reservation->created_at->format('Y-m-d, h:i A') }}</span>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#viewReservation" style="cursor: pointer;">
                                            <i class="fas fa-eye me-1"></i> View
                                        </span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection <!-- End the content section -->
