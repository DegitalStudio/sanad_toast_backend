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
        Schema::create('modifiers', function (Blueprint $table) {
            $table->id();
            $table->string('toast_guid')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('nutrition_item_id')->nullable()->constrained('nutrition_items')->onDelete('set null');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('modifier_type')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifiers');
    }
};
