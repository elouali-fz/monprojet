<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;
use App\Models\Produit;


class DetailsCommande extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
