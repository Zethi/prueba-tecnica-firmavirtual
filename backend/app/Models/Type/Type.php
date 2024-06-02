<?php

namespace App\Models\Type;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    public $timestamps = false;

    protected $hidden = ['id'];
    protected $fillable = [
        'name',
    ];

    public function damageRelations(): HasMany
    {
        return $this->hasMany(TypeDamageRelations::class, 'from_type_id', 'id');
    }
}
