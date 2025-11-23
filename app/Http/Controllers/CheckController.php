<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Panier;
use App\Models\Utilisateur;
use App\Models\PanierDetails;
use App\Models\Commande;
use App\Models\DetailsCommande;

class CheckoutController extends Controller
{
    // Affiche la page de validation (achat.html)
    public function index()
    {
        $user = $user = Utilisateur::find(Auth::id()); // Récupère l'utilisateur connecté

        // 1. Récupérer le Panier (lecture directe de la DB)
        $Panier = $user->panier()->with('details.produit')->first();

        if (!$Panier || $Panier->details->isEmpty()) {
            // Gérer le cas où le panier est vide
            return redirect('/')->with('error', 'Votre panier est vide.');
        }

        // 2. Récupérer l'Adresse (de la Personne 1)
        // (En supposant que l'adresse est sur le modèle Utilisateur)
        $adresse = $user->adresse_livraison;

        // Calculer le total
        $total = $Panier->details->sum(function($detail) {
            return $detail->produit->prix * $detail->quantite;
        });

        return view('checkout.index', [
            'itemsPanier' => $Panier->details,
            'total' => $total,
            'adresse' => $adresse
        ]);
    }

    // Gère la création de la commande
    public function store(Request $request)
    {
        $user = Utilisateur::find(Auth::id());
        $Panier = $user->panier()->with('details.produit')->first();
        $adresse = $user->adresse_livraison;

        // 3. (Simuler) une validation de paiement
        $PaiementValide = true;

        if ($PaiementValide && $Panier) {

            // 5. Créer la Commande finale
            $commande = Commande::create([
                'utilisateur_id' => $user->id,
                'adresse_livraison' => $adresse,
                'total' => $Panier->details->sum(fn($d) => $d->produit->prix * $d->quantite),
                'statut' => 'payee'
            ]);

            // 4. Transférer les DetailPanier en DetailCommande
            foreach ($Panier->details as $item) {
                DetailsCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $item->produit_id,
                    'quantite' => $item->quantite,
                    'prix_unitaire' => $item->produit->prix
                ]);
            }

            // 6. Vider le Panier (de la base de données)
            $Panier->details()->delete();
            // Optionnel : supprimer aussi le panier lui-même
            // $Panier->delete();

            return redirect()->route('commandes.index')->with('success', 'Commande passée !');
        }

        return redirect()->route('checkout.index')->with('error', 'Le paiement a échoué.');
    }
}
