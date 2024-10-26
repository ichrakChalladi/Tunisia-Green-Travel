@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h2>{{ $evenement->nom }}</h2>
</div>

<div class="d-flex justify-content-center" style="transform : scale(1.15)">
    <div class="card col-6 mx-auto p-2">
        <div class="card-header mx-4 p-3 text-center">
            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                <i class="material-icons opacity-10">event</i> <!-- Updated to 'event' icon -->
            </div>
        </div>
        <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center">{{ $evenement->nom }}</h6>
            <span class="text-sm">{{ $evenement->description }}</span>
            <br>

                <i class="material-icons mt-1">location_on</i> <!-- 'me-2' adds margin to the right -->
                <span class="text-sm">{{ $evenement->lieu->adresse }}</span>
            

            <hr class="horizontal dark my-3">
            <h6 class="mb-0">{{ \Carbon\Carbon::parse($evenement->date_debut)->translatedFormat('l, F j, Y') }} to {{ \Carbon\Carbon::parse($evenement->date_fin)->translatedFormat('l, F j, Y') }}</h6>
        </div>

    </div>

</div>

<div class="d-flex justify-content-center mt-5">

    <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" class="d-inline ms-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</button>
    </form>
</div>


@endsection