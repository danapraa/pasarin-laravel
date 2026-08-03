<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->restrictOnDelete();
            $table->string('status')->default('pending');
            $table->string('tracking_number')->nullable();
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->index('order_id');
            $table->index(['store_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_stores');
    }
};
