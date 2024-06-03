<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    public $timestamps = false;

    protected $hidden = ['id'];

    protected $fillable = [
        'name',
        'game_order',
        'effect',
        'short_effect',
    ];
}
