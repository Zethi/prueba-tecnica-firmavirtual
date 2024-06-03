<?php

namespace App\Models\Type;

use Illuminate\Database\Eloquent\Model;

class DamageRelationType extends Model
{
    public $timestamps = false;

    protected $hidden = ['id'];


    protected $fillable = [
        'name',
    ];
}
