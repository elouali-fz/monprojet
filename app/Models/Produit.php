<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
use App\Models\Details_commande;
use App\Models\Sous_famille;
use App\Models\Marque;
use App\Models\Unite;

class Produit extends Model
{
    protected $guarded = ['id'];

    public function details_commande(){
        return $this->hasMany(Details_commande::class);
    }
    public function sous_famille(){
        return $this->belongsTo(Sous_famille::class);
    }
    public function marque(){
        return $this->belongsTo(Marque::class);
    }
    public function unite(){
        return $this->belongsTo(Unite::class);
    }

}