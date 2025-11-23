<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Panier extends Model
{
    protected $table = 'Panier';

    // Relation: Un Panier a plusieurs lignes de détails
    public function details()
    {
        return $this->hasMany(PanierDetails::class, 'panier_id');
    }
}
