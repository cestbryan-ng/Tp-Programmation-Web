<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// IMPORTANT: Si vous utilisez l'authentification Laravel,
// ce modèle doit hériter de Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable // ou Model si vous ne gérez pas l'auth
{
    protected $table = 'Utilisateur';

    // Relation: Un Utilisateur a un Panier
    public function panier()
    {
        return $this->hasOne(Panier::class, 'utilisateur_id');
    }

    // Relation: Un Utilisateur a plusieurs Commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'utilisateur_id');
    }
}
