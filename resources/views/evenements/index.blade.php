@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between">
        <h3>Liste des événements écoresponsables</h3>
        <a href="{{ route('evenements.create') }}" class="btn btn-success mb-3">Créer un événement</a>
    </div>



    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Liste des événements</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if($evenements->isEmpty())
                            <p>Aucun événement trouvé.</p>
                            @else
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date de début</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de fin</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lieu</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evenements as $evenement)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Vite::asset('resources/assets/img/event.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">


                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $evenement->nom }}</h6>
                                                    <p class="text-xs text-secondary mb-0">Description</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $evenement->date_debut }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">{{ $evenement->date_fin }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $evenement->lieu->nom }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('evenements.show', $evenement->id) }}" class="btn btn-info  btn-sm text-xs">Voir</a>
                                            <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning  btn-sm text-xs">Modifier</a>
                                            <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger  btn-sm text-xs" onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
@endsection