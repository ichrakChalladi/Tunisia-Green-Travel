@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="mt-3" id="alert-custom" style="position: absolute; z-index:90099; display: flex; justify-content: center; width: 100%;">
  <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; transform: translate(-25%, -50%);">
    <strong class="ms-3">Reservation</strong> Created successfully !
  </div>
</div>
@endif


<div class="container">
  <div class="row">
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h5 class="mb-0">Reservations List</h5>
        </div>

        <div class="card-body pt-4 p-4">
          <ul class="list-group">

            @foreach($reservations as $reservation)
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg mb-3">

              <div class="container row">
                <div class="d-flex flex-column col-6">
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2">Traveler name</h6>
                  <h6 class="mb-4 text-sm">{{ $reservation->customer_name }}</h6>

                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2">Newest</h6>
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg p-4">
                      <div class="d-flex align-items-center ms-4">
                        <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                        <div class="d-flex flex-column">
                          <h6 class="mb-1 text-dark text-sm">Check-In Date</h6>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d F, Y') }}</td>
                      </div>
                    </li>

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg p-4">
                      <div class="d-flex align-items-center ms-4">
                        <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_more</i></button>
                        <div class="d-flex flex-column me-5">
                          <h6 class="mb-1 text-dark text-sm">Check-Out Date</h6>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d F, Y') }}</td>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="d-flex flex-column col-5 ms-4">
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2">Email</h6>
                  <h6 class="mb-3 text-sm">{{ $reservation->customer_email }}</h6>

                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2 mt-3">Room number</h6>
                  <h6 class="mb-3 text-sm">{{ $reservation->room->name }}</h6>

                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2 mt-3">Number of guests </h6>
                  <h6 class="mb-3 text-sm">{{ $reservation->number_of_guests }}</h6>

                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-2 mt-3">Status </h6>

                  @if($reservation->status == 'pending')
                  <h6 class="text-warning">Pending</h6>
                  @elseif($reservation->status == 'approved')
                  <h6 class="text-success">Approved</h6>
                  @else
                  <h6 class="text-danger">Other Status</h6>
                  @endif


                </div>
              </div>


              <div class="ms-auto text-end">
                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-link text-danger text-gradient px-3 mb-0" type="submit">
                    <i class="fas fa-times-circle text-danger me-1"></i>Cancel Reservation
                  </button>
                </form>
                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('reservations.edit', $reservation) }}">
                  <i class="material-icons text-sm me-2">edit</i>Edit
                </a>
              </div>
            </li>
            @endforeach

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  setTimeout(function() {
    document.getElementById('alert-custom').style.display = 'none';
  }, 3000);
</script>
@endsection