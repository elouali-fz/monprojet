<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SousFamille;


class Famille extends Model
{
    protected $guarded = ['id'];

    public function sousFamille(){
        return $this->hasMany(SousFamille::class);
    }
}
