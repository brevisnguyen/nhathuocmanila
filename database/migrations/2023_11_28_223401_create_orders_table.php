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
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('payment')->nullable();
            $table->string('status')->nullable();
            $table->string('attachments', 512)->nullable();
            $table->string('description')->nullable();
            $table->decimal('subtotal')->default(0);
            $table->decimal('shipping')->default(0);
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
