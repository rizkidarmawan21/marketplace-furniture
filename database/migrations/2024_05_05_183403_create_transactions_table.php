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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('phone_number');
            $table->string('invoice_code');
            $table->string('total_price'); // di dapat dari total pembelian 
            $table->string('payment_url')->nullable();
            $table->enum('status', ['pending', 'onprogress', 'success', 'failed'])->default('pending');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transaction_shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();

            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_address');
            $table->string('receiver_province');
            $table->string('receiver_city');
            $table->string('receiver_postal_code')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transaction_shippings');
    }
};
