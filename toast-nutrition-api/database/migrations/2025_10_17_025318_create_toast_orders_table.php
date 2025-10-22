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
        Schema::create('toast_orders', function (Blueprint $table) {
            $table->id();
            $table->string('toast_order_guid')->unique();
            $table->string('order_number')->nullable();
            $table->string('restaurant_guid')->nullable();
            $table->string('check_guid')->nullable();
            $table->enum('status', ['new', 'modified', 'voided', 'completed', 'cancelled'])->default('new');
            $table->timestamp('order_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->enum('order_type', ['dine_in', 'takeout', 'delivery', 'pickup'])->nullable();
            $table->json('raw_data')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toast_orders');
    }
};
