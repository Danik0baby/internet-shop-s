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
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('number')->unique();
            $table->string('status')->default('new');
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('address');
            $table->text('comment')->nullable();
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->unsignedInteger('total');
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
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
