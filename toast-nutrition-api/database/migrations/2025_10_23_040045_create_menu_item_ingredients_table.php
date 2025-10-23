<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_item_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('nutrition_item_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 8, 2)->default(1); // For multiple servings
            $table->timestamps();

            // Ensure each ingredient can only be added once per menu item
            $table->unique(['menu_item_id', 'nutrition_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_ingredients');
    }
};
