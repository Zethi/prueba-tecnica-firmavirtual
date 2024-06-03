<?php

namespace App\Models\Type;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeDamageRelations extends Model
{
    public $timestamps = false;

    protected $hidden = ['id', 'from_type_id', 'damage_relation_type_id', 'to_type_id'];


    protected $fillable = [
        'from_type_id',
        'damage_relation_type_id',
        'to_type_id',
    ];

    public function FromTypeClass(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'from_type_id');
    }

    public function damageRelationType(): BelongsTo
    {
        return $this->belongsTo(DamageRelationType::class, 'damage_relation_type_id');
    }

    public function toType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'to_type_id');
    }
}
