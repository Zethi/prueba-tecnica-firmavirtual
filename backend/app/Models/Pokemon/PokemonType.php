<?php

namespace App\Models\Pokemon;

use App\Models\Type\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PokemonType extends Model
{
    public $timestamps = false;

    protected $hidden = ['id', 'pokemon_id', 'type_id'];
    protected $fillable = [
        'pokemon_id',
        'type_id',
        'slot'
    ];

    public function PokemonClass(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
