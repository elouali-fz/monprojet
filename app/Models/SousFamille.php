<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousFamille extends Model
{
    protected $guarded = ['id'];

    public function produit(){
        return $this->hasMany(Produit::class);
    }
    public function famille(){
        return $this->belongsTo(Famille::class);
    }
}
