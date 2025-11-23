<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DetailsCommande extends Model
{
    protected $table = 'Details_commande';
    protected $guarded = []; // Permet de tout remplir
    public $timestamps = false; // Désactive created_at/updated_at

    // Relation: Ce détail concerne un Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
