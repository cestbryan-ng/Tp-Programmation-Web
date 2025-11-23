<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Commande extends Model
{
    protected $table = 'Commande';
    protected $guarded = []; // Permet de tout remplir

    // Relation: Une Commande a plusieurs lignes de détails
    public function details()
    {
        return $this->hasMany(DetailsCommande::class, 'commande_id');
    }
}
