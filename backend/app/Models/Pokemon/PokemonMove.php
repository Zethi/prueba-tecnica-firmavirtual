<?php

namespace App\Models\Pokemon;

use App\Models\Move;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PokemonMove extends Model
{
    public $timestamps = false;

    protected $hidden = ['id', 'pokemon_id', 'move_id'];

    protected $fillable = [
        'pokemon_id',
        'move_id'
    ];

    public function move(): HasOne
    {
        return $this->hasOne(Move::class, 'id', 'move_id');
    }
}
