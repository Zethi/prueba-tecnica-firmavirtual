<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $timestamps = false;
    protected $hidden = ['id'];

    protected $fillable = [
        'name',
        'game_index',
        'is_battle_only'
    ];
}
