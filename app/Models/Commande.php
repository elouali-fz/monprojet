<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detailsCommande(){
        return $this->hasMany(DetailCommande::class, 'commande_id');
    }

    public function etat(){
        return $this->belongsTo(Etat::class);
    }

    public function modeReglement(){
        return $this->belongsTo(ModeReglement::class);
    }
}
