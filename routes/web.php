<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController; // Assurez-vous de l'importer
use App\Http\Controllers\PanierController;
// Route pour la page d'accueil (artika.php)
Route::get('/', function () {
    // Ici, vous devriez aussi récupérer les produits vedettes
    // et les passer à la vue
    return view('artika');
})->name('accueil');

// Route pour la page single-product (description.html)
// Elle utilise le "ProduitController" que nous avons défini
Route::get('/produit/{produit}', [ProduitController::class, 'show'])->name('produit.show');

// Route pour la page panier (panier.html)
Route::get('/panier/{panier}', [ProduitController::class, 'show'])->name('panier.show');

// Routes pour votre tâche de Checkout
// (Utilise le CheckoutController que nous avons défini)
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommandeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.index');
});

// N'oubliez pas la route pour l'ajout au panier (gérée par la Personne 2)
// Route::post('/panier/add', [CartController::class, 'add'])->name('panier.add');

// Route pour afficher tous les produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');

// Route pour afficher le panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
