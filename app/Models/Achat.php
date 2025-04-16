<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fournisseur;
use App\Models\Details_achat;

class Achat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function details_achat()
    {
        return $this->hasMany(Details_achat::class);
    }
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
