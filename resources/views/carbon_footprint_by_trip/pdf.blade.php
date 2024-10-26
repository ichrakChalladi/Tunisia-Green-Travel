<!DOCTYPE html>
<html>
<head>
    <title>Détails du Trip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <h1>Détails du Trip</h1>
    <p><strong>Option de Transport :</strong> {{ $trip->transportOption->name }} ({{ $trip->transportOption->type }})</p>
    <p><strong>Point de Départ :</strong> {{ $trip->starting_point }}</p>
    <p><strong>Destination :</strong> {{ $trip->destination }}</p>
    <p><strong>Distance :</strong> {{ $trip->distance }} km</p>
    <p><strong>Passagers :</strong> {{ $trip->passengers }}</p>
    <p><strong>Date de Début :</strong> {{ $trip->start_date }}</p>
    <p><strong>Date de Fin :</strong> {{ $trip->end_date }}</p>
    <p><strong>Empreinte Carbone :</strong> {{ $trip->calculated_carbon_footprint }} kg CO2</p>
    <p><strong>Prix du Trip :</strong> ${{ $trip->trip_price }}</p>
</body>
</html>
