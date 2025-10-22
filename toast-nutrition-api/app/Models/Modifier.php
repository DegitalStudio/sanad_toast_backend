<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modifier extends Model
{
    protected $fillable = [
        'toast_guid',
        'name',
        'description',
        'nutrition_item_id',
        'price',
        'modifier_type',
        'is_active',
        'metadata',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    public function nutritionItem(): BelongsTo
    {
        return $this->belongsTo(NutritionItem::class);
    }
}
