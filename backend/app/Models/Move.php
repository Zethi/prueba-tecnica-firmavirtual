<?php

namespace App\Models;

use App\Models\Type\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Move extends Model
{
    public $timestamps = false;

    protected $hidden = ['id', 'damage_class_id', 'type_id'];

    protected $fillable = [
        'name',
        'pp',
        'power',
        'priority',
        'accuracy',
        'damage_class_id',
        'type_id'
    ];

    public function damageClass(): BelongsTo
    {
        return $this->belongsTo(DamageClass::class, 'damage_class_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
