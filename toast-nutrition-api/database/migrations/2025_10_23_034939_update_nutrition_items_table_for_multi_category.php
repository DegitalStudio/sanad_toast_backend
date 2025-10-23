<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('nutrition_items', function (Blueprint $table) {
            // Drop the 'code' unique constraint as it's not needed for Wix imports
            $table->dropUnique(['code']);
            $table->dropColumn('code');

            // Update category to be an enum with specific values
            $table->dropColumn('category');
        });

        Schema::table('nutrition_items', function (Blueprint $table) {
            $table->enum('category', [
                'ingredient',  // Base ingredients (lettuce, chicken, onion, etc.)
                'topping',     // Toppings collection (add-ons)
                'dressing',    // Dressings collection
                'side',        // Sides collection
                'sweet',       // Sweets/desserts collection
                'juice',       // Homemade juice collection
            ])->after('name');

            // Rename columns to match Wix CSV format
            $table->renameColumn('total_fat', 'fat');
            $table->renameColumn('total_carbohydrates', 'carbs');
            $table->renameColumn('dietary_fiber', 'fiber');
            $table->renameColumn('sugars', 'sugar');

            // Add servings field (from Wix CSV)
            $table->decimal('servings', 8, 2)->default(1)->after('category');

            // Add index for better query performance
            $table->index(['category', 'name']);
        });

        // Drop unnecessary columns for this project
        Schema::table('nutrition_items', function (Blueprint $table) {
            $table->dropColumn([
                'saturated_fat',
                'trans_fat',
                'cholesterol',
                'vitamin_a',
                'vitamin_c',
                'calcium',
                'iron',
                'serving_size',
                'serving_unit',
                'is_active'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nutrition_items', function (Blueprint $table) {
            // Restore original structure
            $table->string('code')->unique()->after('name');
            $table->string('category')->nullable()->change();
            $table->renameColumn('fat', 'total_fat');
            $table->renameColumn('carbs', 'total_carbohydrates');
            $table->renameColumn('fiber', 'dietary_fiber');
            $table->renameColumn('sugar', 'sugars');
            $table->dropColumn('servings');
            $table->dropIndex(['category', 'name']);

            // Restore dropped columns
            $table->decimal('saturated_fat', 10, 2)->default(0);
            $table->decimal('trans_fat', 10, 2)->default(0);
            $table->decimal('cholesterol', 10, 2)->default(0);
            $table->decimal('vitamin_a', 10, 2)->default(0);
            $table->decimal('vitamin_c', 10, 2)->default(0);
            $table->decimal('calcium', 10, 2)->default(0);
            $table->decimal('iron', 10, 2)->default(0);
            $table->decimal('serving_size', 10, 2)->nullable();
            $table->string('serving_unit')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }
};
