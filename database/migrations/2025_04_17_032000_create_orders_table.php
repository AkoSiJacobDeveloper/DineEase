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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Simplified statuses
            $table->enum('status', [
                'pending',    // Order placed, awaiting confirmation
                'confirmed',  // Order accepted by restaurant
                'completed'   // Order fulfilled
            ])->default('pending');
            
            // Essential financial columns
            $table->decimal('subtotal', 10, 2);
            $table->decimal('service_charge', 10, 2);
            $table->decimal('total', 10, 2);
            
            // Basic order info
            $table->string('order_number')->unique();
            $table->text('notes')->nullable();
            
            // Payment
            $table->string('payment_method')->nullable();
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};