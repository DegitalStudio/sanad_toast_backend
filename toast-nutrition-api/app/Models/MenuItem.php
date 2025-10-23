<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'toast_menu_id',
        'name',
        'description',
        'category',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get all ingredients for this menu item
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(NutritionItem::class, 'menu_item_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get all orders that include this menu item
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Calculate base nutrition for this menu item
     */
    public function calculateBaseNutrition()
    {
        $totals = [
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
            'fiber' => 0,
            'sodium' => 0,
            'sugar' => 0,
        ];

        foreach ($this->ingredients as $ingredient) {
            $quantity = $ingredient->pivot->quantity;
            $totals['calories'] += $ingredient->calories * $quantity;
            $totals['protein'] += $ingredient->protein * $quantity;
            $totals['fat'] += $ingredient->fat * $quantity;
            $totals['carbs'] += $ingredient->carbs * $quantity;
            $totals['fiber'] += $ingredient->fiber * $quantity;
            $totals['sodium'] += $ingredient->sodium * $quantity;
            $totals['sugar'] += $ingredient->sugar * $quantity;
        }

        return $totals;
    }
}
