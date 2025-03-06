<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $guarded=['id'];
    public function produit(){
        return $this->hasMany(Produit::class);
    }
    use HasFactory;
}
