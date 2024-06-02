<?php

namespace App\Models\Pokemon;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PokemonAbility extends Model
{
    public $timestamps = false;

    protected $hidden = ['pokemon_id', 'id', 'ability_id'];

    protected $fillable = [
        'pokemon_id',
        'ability_id',
        'slot'
    ];

    public function ability(): HasOne
    {
        return $this->hasOne(Ability::class, 'id', 'ability_id');
    }
}
