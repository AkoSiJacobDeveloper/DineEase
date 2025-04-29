<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Changed 'food' to 'foods'
            $table->integer('quantity');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('service_charge', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->string('order_number')->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};