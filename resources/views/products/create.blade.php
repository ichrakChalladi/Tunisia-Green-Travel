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
    <title>Créer un Produit</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Intégration de FontAwesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-title {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="form-title">Créer un Produit</h1>

        <!-- Affichage des erreurs de validation -->
        @if($errors->any())
            <div class="alert alert-danger text-white" role="alert">
                <strong>Erreur!</strong> Veuillez corriger les erreurs ci-dessous.
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Affichage du message de succès -->
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

        <!-- Formulaire de création -->
        <form method="post" action="{{ route('product.store') }}">
            @csrf

            <div class="form-group">
                <label for="nom_produit">Nom du Produit</label>
                <input type="text" class="form-control" id="nom_produit" name="nom_produit" placeholder="Nom du Produit">
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie">
            </div>

            <div class="form-group">
                <label for="conseils_utilisation">Conseils d'Utilisation</label>
                <input type="text" class="form-control" id="conseils_utilisation" name="conseils_utilisation" placeholder="Conseils d'Utilisation">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- Intégration de Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Intégration de FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>

@endsection <!-- End the content section -->