<?php

namespace App\Models\Pokemon;

use App\Models\Move;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pokemon extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'game_id',
        'order',
        'base_experience',
        'height',
        'weight'
    ];

    public function stats(): HasMany
    {
        return $this->hasMany(PokemonStat::class, 'pokemon_id', 'game_id');
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(PokemonAbility::class, 'pokemon_id', 'game_id');
    }

    public function moves(): HasMany
    {
        return $this->hasMany(PokemonMove::class, 'pokemon_id', 'game_id');
    }

    public function types(): HasMany
    {
        return $this->hasMany(PokemonType::class, 'pokemon_id', 'game_id');
    }
}
