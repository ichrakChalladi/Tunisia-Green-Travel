<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Affiche la liste des produits
    public function index(){
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    // Affiche le formulaire pour créer un produit
    public function create(){
        return view('products.create');
    }

    // Enregistre un nouveau produit
    public function store(Request $request){
        // Valider les données
        $data = $request->validate([
            'nom_produit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:255',
            'conseils_utilisation' => 'required|string',
            'adresse' => 'required|string|max:255',
        ]);

        // Créer un nouveau produit avec les données validées
        $newProduct = Product::create($data);

        // Rediriger vers la liste des produits
        return redirect(route('product.index'))->with('success', 'Product created successfully');
    }

    // Affiche le formulaire d'édition d'un produit
    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }

    // Met à jour un produit
    public function update(Product $product, Request $request){
        // Valider les données
        $data = $request->validate([
            'nom_produit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:255',
            'conseils_utilisation' => 'required|string',
            'adresse' => 'required|string|max:255',
        ]);

        // Mettre à jour le produit avec les nouvelles données
        $product->update($data);

        // Rediriger vers la liste des produits avec un message de succès
        return redirect(route('product.index'))->with('success', 'Product updated successfully');
    }

    // Supprime un produit
    public function destroy(Product $product){
        $product->delete();
        return redirect(route('product.index'))->with('success', 'Product deleted successfully');
    }
}
