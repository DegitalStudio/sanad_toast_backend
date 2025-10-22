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
        Schema::create('nutrition_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->decimal('calories', 10, 2)->default(0);
            $table->decimal('total_fat', 10, 2)->default(0);
            $table->decimal('saturated_fat', 10, 2)->default(0);
            $table->decimal('trans_fat', 10, 2)->default(0);
            $table->decimal('cholesterol', 10, 2)->default(0);
            $table->decimal('sodium', 10, 2)->default(0);
            $table->decimal('total_carbohydrates', 10, 2)->default(0);
            $table->decimal('dietary_fiber', 10, 2)->default(0);
            $table->decimal('sugars', 10, 2)->default(0);
            $table->decimal('protein', 10, 2)->default(0);
            $table->decimal('vitamin_a', 10, 2)->default(0);
            $table->decimal('vitamin_c', 10, 2)->default(0);
            $table->decimal('calcium', 10, 2)->default(0);
            $table->decimal('iron', 10, 2)->default(0);
            $table->json('calculation_details')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('calculated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_calculations');
    }
};
