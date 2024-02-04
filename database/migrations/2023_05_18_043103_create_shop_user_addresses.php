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
        Schema::create('shop_user_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_user_id');

            $table->string('country')->default('LB')->index();
            $table->string('state')->default('');
            $table->string('city')->default('');
            $table->string('area')->default('');
            $table->string('address_line1')->default('');
            $table->string('address_line2')->default('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_user_addresses');
    }
};
