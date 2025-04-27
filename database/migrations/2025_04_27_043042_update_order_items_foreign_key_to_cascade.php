<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['order_id']);
            // Add new foreign key with cascade
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Revert to original foreign key
            $table->dropForeign(['order_id']);
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders');
        });
    }
};