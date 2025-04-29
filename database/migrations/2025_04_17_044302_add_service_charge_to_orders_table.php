<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->after('status');
            }
            if (!Schema::hasColumn('orders', 'service_charge')) {
                $table->decimal('service_charge', 10, 2)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('service_charge');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'subtotal')) {
                $table->dropColumn('subtotal');
            }
            if (Schema::hasColumn('orders', 'service_charge')) {
                $table->dropColumn('service_charge');
            }
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
        });
    }
};