<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function achats()
    {
        return $this->hasMany(Achat::class);
    }
}
