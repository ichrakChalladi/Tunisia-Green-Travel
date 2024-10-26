<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Lieu;


class EvenementController extends Controller
{
    //Afficher la liste des événements
    public function index()
    {
        $evenements = Evenement::with('lieu')->get();
        return view('evenements.index', compact('evenements'));
    }

    //Afficher le formulaire de création
    public function create()
    {
        $lieus = Lieu::all(); // Récupérer tous les lieus pour les options du formulaire
        return view('evenements.create', compact('lieus'));
    }

    //Enregistrer un événement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu_id' => 'required|exists:lieus,id',
        ]);
    
        Evenement::create($validated);
    
        return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès');
    }

    //Afficher le formulaire d'édition
    public function edit(Evenement $evenement)
    {
        $lieus = Lieu::all(); // Pour les options des lieus
        return view('evenements.edit', compact('evenement', 'lieus'));
    }

    //Mettre à jour un événement
    public function update(Request $request, Evenement $evenement)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu_id' => 'required|exists:lieus,id',
        ]);
    
        $evenement->update($validated);
    
        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès');
    }

    //Supprimer un événement
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès');
    }

    //afficher 
    public function show(Evenement $evenement)
    {
        // Récupérer l'événement avec son lieu associé
        $evenement->load('lieu'); // Charge la relation "lieu" pour éviter une requête supplémentaire
    
        // Retourner la vue avec l'événement à afficher
        return view('evenements.show', compact('evenement'));
    }


}
