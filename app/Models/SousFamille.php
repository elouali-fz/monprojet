<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
use App\Models\Famille;

class Sous_famille extends Model
{
    protected $guarded = ['id'];

    public function produit(){
        return $this->hasMany(Produit::class);
    }
    public function famille(){
        return $this->belongsTo(Famille::class);
    }
}
