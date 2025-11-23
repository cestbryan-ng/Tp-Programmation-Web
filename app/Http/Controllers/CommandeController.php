<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use Dflydev\DotAccessData\Util;

class CommandeController extends Controller
{
    // Affiche la page "Mes Commandes"
    public function index()
    {   $commande_user=Utilisateur::find(Auth::id());
        $commandes = $commande_user->commandes()->with('details.produit')->latest()->get();

        return view('commandes.index', [
            'commandes' => $commandes
        ]);
    }
}
