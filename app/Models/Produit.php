<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $guarded = ['id'];

    public function details_commande(){
        return $this->hasMany(DetailsCommande::class);
    }
    public function sous_famille(){
        return $this->belongsTo(SousFamille::class);
    }
    public function marque(){
        return $this->belongsTo(Marque::class);
    }
    public function unite(){
        return $this->belongsTo(Unite::class);
    }









}