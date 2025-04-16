<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_achat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function achat()
    {
        return $this->belongsTo(Achat::class);
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function getTotalTtcAttribute() {
        return ($this->prix_ht + ($this->prix_ht * $this->tva / 100)) * $this->quantite;
    }
}
