<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NutritionItem extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'category',
        'serving_size',
        'serving_unit',
        'calories',
        'total_fat',
        'saturated_fat',
        'trans_fat',
        'cholesterol',
        'sodium',
        'total_carbohydrates',
        'dietary_fiber',
        'sugars',
        'protein',
        'vitamin_a',
        'vitamin_c',
        'calcium',
        'iron',
        'is_active',
    ];

    protected $casts = [
        'serving_size' => 'decimal:2',
        'calories' => 'decimal:2',
        'total_fat' => 'decimal:2',
        'saturated_fat' => 'decimal:2',
        'trans_fat' => 'decimal:2',
        'cholesterol' => 'decimal:2',
        'sodium' => 'decimal:2',
        'total_carbohydrates' => 'decimal:2',
        'dietary_fiber' => 'decimal:2',
        'sugars' => 'decimal:2',
        'protein' => 'decimal:2',
        'vitamin_a' => 'decimal:2',
        'vitamin_c' => 'decimal:2',
        'calcium' => 'decimal:2',
        'iron' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function modifiers(): HasMany
    {
        return $this->hasMany(Modifier::class);
    }
}
