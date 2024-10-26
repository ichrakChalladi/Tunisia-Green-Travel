@extends('layouts.app')

@section('content')
<div class="container card col-9 p-3">
    <h3>Modifier l'événement : {{ $evenement->nom }}</h3>

    <form action="{{ route('evenements.update', $evenement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nom">Nom de l'événement</label>
        <div class="form-group input-group input-group-outline mb-2">
            <input type="text" name="nom" class="form-control" placeholder="Entrez le nom de l'événement" value="{{ $evenement->nom }}" required>
        </div>

        <label for="description">Description</label>
        <div class="form-group input-group input-group-outline mb-2">
            <textarea name="description" class="form-control" placeholder="Entrez la description" rows="3" required>{{ $evenement->description }}</textarea>
        </div>

        <label for="date_debut">Date de début</label>
        <div class="form-group input-group input-group-outline mb-2">
            <input type="date" name="date_debut" class="form-control" value="{{ $evenement->date_debut }}" required>
        </div>

        <label for="date_fin">Date de fin</label>
        <div class="form-group input-group input-group-outline mb-2">
            <input type="date" name="date_fin" class="form-control" value="{{ $evenement->date_fin }}" required>
        </div>

        <label for="lieu">Lieu</label>
        <div class="form-group input-group input-group-outline mb-2">
            <select name="lieu_id" class="form-control" required>
                @foreach($lieus as $lieu)
                <option value="{{ $lieu->id }}" {{ $evenement->lieu_id == $lieu->id ? 'selected' : '' }}>
                    {{ $lieu->nom }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
</div>
@endsection