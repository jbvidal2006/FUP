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
            $table->string('pro_name',40);
            $table->string('pro_type',40);
            $table->Integer('pro_amount');
            $table->double('pro_price',8,2);
            $table->text('pro_image');
            $table->boolean('pro_certs');
            $table->foreignId('categories_cat_id')->references('id')->on('categories');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
