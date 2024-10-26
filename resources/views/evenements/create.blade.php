@extends('layouts.app')

@section('content')
<div class="container card col-9 p-3">
    <h3>Créer un nouvel événement écoresponsable</h3>
    
    <form action="{{ route('evenements.store') }}" method="POST">
        @csrf

        <label for="nom">Nom de l'événement</label>
        <div class="input-group input-group-outline mb-2">
            <input type="text" name="nom" class="form-control" placeholder="Entrez le nom de l'événement" required>
        </div>

        <label for="description">Description</label>
        <div class="input-group input-group-outline mb-2">
            <textarea name="description" class="form-control" placeholder="Entrez la description" rows="3" required></textarea>
        </div>
        
        <label for="date_debut">Date de début</label>
        <div class="input-group input-group-outline mb-2">
            <input type="date" name="date_debut" class="form-control" required>
        </div>
        
        <label for="date_fin">Date de fin</label>
        <div class="input-group input-group-outline mb-2">
            <input type="date" name="date_fin" class="form-control" required>
        </div>
        
        <label for="lieu">Lieu</label>
        <div class="input-group input-group-outline  mb-3">
            <select name="lieu_id" class="form-control" required>
                <option value="">Sélectionnez un lieu</option>
                @foreach($lieus as $lieu)
                    <option value="{{ $lieu->id }}">{{ $lieu->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
