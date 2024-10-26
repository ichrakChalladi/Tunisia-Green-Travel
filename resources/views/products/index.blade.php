<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app') <!-- Extending the layout file -->

@section('title', 'Dashboard') <!-- Define the title for this page -->

@section('content') <!-- Start the content section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des Produits</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Intégration de FontAwesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            margin-top: 20px;
        }

        .btn-create {
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center">Gestion des Produits</h1>

        <!-- Affichage des messages de succès -->
        @if(session()->has('success'))
        <div class="alert alert-success text-white" role="alert">
            <strong>Succès!</strong> {{ session('success') }}
        </div>
        @endif

        <!-- Affichage des messages d'information -->
        @if(session()->has('info'))
        <div class="alert alert-info text-white" role="alert">
            <strong>Info!</strong> {{ session('info') }}
        </div>
        @endif

        <!-- Affichage des messages d'avertissement -->
        @if(session()->has('warning'))
        <div class="alert alert-warning text-white" role="alert">
            <strong>Avertissement!</strong> {{ session('warning') }}
        </div>
        @endif

        <!-- Affichage des erreurs -->
        @if(session()->has('error'))
        <div class="alert alert-danger text-white" role="alert">
            <strong>Erreur!</strong> {{ session('error') }}
        </div>
        @endif

        <!-- Bouton pour créer un nouveau produit -->
        <div class="text-right">
            <a href="{{ route('product.create') }}" class="btn btn-success btn-create">
                <i class="fas fa-plus-circle"></i> Créer un Produit
            </a>
        </div>

        <!-- Table des produits -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom du Produit</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Conseils d'Utilisation</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->nom_produit }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->categorie }}</td>
                    <td>{{ $product->conseils_utilisation }}</td>
                    <td>{{ $product->adresse }}</td>
                    <td class="action-buttons">

                        <span class="badge badge-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#viewProduct" style="cursor: pointer;"> <i class="fas fa-eye me-1"> </i> Check</span>

                        <!-- Bouton Modifier avec icône -->
                        <a href="{{ route('product.edit', ['product' => $product]) }}" class="btn btn-primary btn-sm" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Bouton Supprimer avec icône -->
                        <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Intégration de Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Intégration de FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>

</html>



<!-- View Review Modal -->
<div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewLabel">Review overview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="mb-xl-0">
                    <div class="card card-blog card-plain">
                        <div class="card-header">
                                <img src="{{ Vite::asset('resources/assets/img/home-decor-1.jpg') }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                        
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-0 text-sm">Project #2</p>
                            <a href="javascript:;">
                                <h5>
                                    {{ $product->nom_produit }}
                                </h5>
                            </a>
                            <p class="mb-4 text-sm">
                                As Uber works through a huge amount of internal management turmoil.
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                <div class="avatar-group mt-2">
                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                        <img alt="Elena Morison" src="{{ Vite::asset('resources/assets/img/team-1.jpg') }}">
                                    </a>
                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                        <img alt="Ryan Milly" src="{{ Vite::asset('resources/assets/img/team-2.jpg') }}">
                                    </a>
                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                        <img alt="Nick Daniel" src="{{ Vite::asset('resources/assets/img/team-3.jpg') }}">
                                    </a>
                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                        <img alt="Peterson" src="{{ Vite::asset('resources/assets/img/team-4.jpg') }}">
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>


@endsection <!-- End the content section -->