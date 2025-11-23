<?php
namespace App\Http\Controllers;
use App\Models\Produit; // <-- Utilisez votre modèle

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all(); // Récupérer tous les produits
        return view('produits.index', compact('produits'));
    }

    public function show(Produit $produit)
    {
        // $produit est automatiquement trouvé par Laravel (ex: /produit/1)

        // $produit->load('artiste', 'images'); // Décommentez si vous avez ces relations

        return view('produits.show', [
            'produit' => $produit
        ]);
    }
}
