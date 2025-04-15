<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Marque extends Model
{
    // Relation avec les produits
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
