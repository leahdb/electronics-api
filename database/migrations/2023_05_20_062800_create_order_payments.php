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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('type')->default(1);
            $table->decimal('amount')->default(0);
            $table->string('currency')->default('USD');
            // could be for storing error messages about the payment attempt :
            $table->string('details')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
