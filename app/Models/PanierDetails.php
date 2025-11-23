<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PanierDetails extends Model
{
    protected $table = 'panier_details';

    // Relation: Une ligne de panier concerne un Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
