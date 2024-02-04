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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("brand_name");
            $table->text("description")->nullable();
            $table->string("image")->default('');            
            $table->integer('index')->nullable();

            $table->float("price");
            $table->integer("stock_quantity")->nullable();

            $table->integer('product_category_id')->nullable();
            $table->integer('moq')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('products');
    }
};
