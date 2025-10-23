<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NutritionItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'servings',
        'calories',
        'protein',
        'fat',
        'carbs',
        'fiber',
        'sodium',
        'sugar',
    ];

    protected $casts = [
        'servings' => 'decimal:2',
        'calories' => 'decimal:2',
        'protein' => 'decimal:2',
        'fat' => 'decimal:2',
        'carbs' => 'decimal:2',
        'fiber' => 'decimal:2',
        'sodium' => 'decimal:2',
        'sugar' => 'decimal:2',
    ];

    /**
     * Get all menu items that use this nutrition item as an ingredient
     */
    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get all modifiers that reference this nutrition item
     */
    public function modifiers(): HasMany
    {
        return $this->hasMany(Modifier::class);
    }

    /**
     * Scope to filter by category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to search by name
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
}
