<?php

namespace App\Models\Pokemon;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PokemonStat extends Model
{
    public $timestamps = false;
    protected $hidden = ['pokemon_id', 'stat_id', 'id'];

    protected $fillable = [
        'pokemon_id',
        'stat_id',
        'base',
        'effort'
    ];

    public function stat(): HasOne
    {
        return $this->hasOne(Stat::class, 'id', 'stat_id');
    }
}
