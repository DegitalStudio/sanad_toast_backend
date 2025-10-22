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
        Schema::create('toast_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->string('event_id')->unique();
            $table->string('restaurant_guid')->nullable();
            $table->json('payload');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->integer('retry_count')->default(0);
            $table->timestamps();

            $table->index(['event_type', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toast_webhooks');
    }
};
