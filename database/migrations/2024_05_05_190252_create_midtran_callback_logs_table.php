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
        Schema::create('midtran_callback_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->json('request');
            $table->string('order_id');
            $table->foreignId('transaction_id')->nullable()->constrained('transactions');
            $table->string('status_code');
            $table->string('payment_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtran_callback_logs');
    }
};
