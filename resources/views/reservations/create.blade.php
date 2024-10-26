@extends('layouts.app')

@section('content')
<div class="container card col-9 p-3">
    <h4 class="text-center mb-4">Create a New Reservation for {{ $selectedRoom ? $selectedRoom->name : 'a Room' }}</h4>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <!-- Room Selection -->
        @if($selectedRoom)
            <input type="hidden" name="room_id" value="{{ $selectedRoom->id }}">
        @else
            <div class="form-group mb-3">
                <label for="room_id">Room</label>
                <div class="input-group input-group-outline mb-2">
                    <select name="room_id" id="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
                        <option value="">Select a room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('room_id')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        @endif

        <!-- Customer Name -->
        <div class="form-group mb-3">
            <label for="customer_name">Customer Name</label>
            <div class="input-group input-group-outline mb-2">
                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required>
            </div>
            @error('customer_name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Customer Email -->
        <div class="form-group mb-3">
            <label for="customer_email">Customer Email</label>
            <div class="input-group input-group-outline mb-2">
                <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email') }}" required>
            </div>
            @error('customer_email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Check-in Date -->
        <div class="form-group mb-3">
            <label for="check_in_date">Check-In Date</label>
            <div class="input-group input-group-outline mb-2">
                <input type="date" name="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror" value="{{ old('check_in_date') }}" required>
            </div>
            @error('check_in_date')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Check-out Date -->
        <div class="form-group mb-3">
            <label for="check_out_date">Check-Out Date</label>
            <div class="input-group input-group-outline mb-2">
                <input type="date" name="check_out_date" class="form-control @error('check_out_date') is-invalid @enderror" value="{{ old('check_out_date') }}" required>
            </div>
            @error('check_out_date')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Number of Guests -->
        <div class="form-group mb-3">
            <label for="number_of_guests">Number of Guests</label>
            <div class="input-group input-group-outline mb-2">
                <input type="number" name="number_of_guests" class="form-control @error('number_of_guests') is-invalid @enderror" min="1" value="{{ old('number_of_guests', 1) }}" required>
            </div>
            @error('number_of_guests')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Reservation</button>
    </form>
</div>
@endsection
