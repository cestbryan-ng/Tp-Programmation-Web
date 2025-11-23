<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;

class PanierController extends Controller
{
    public function index()
    {
        $panier = Panier::with('details')->first(); // Exemple : récupérer le panier avec ses détails
        return view('panier.index', compact('panier'));
    }
}
