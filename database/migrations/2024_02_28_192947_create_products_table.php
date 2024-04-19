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
            $table->string('pro_name',80);
            $table->string('pro_type',40);
            $table->Integer('pro_price');
            $table->string('pro_certs');
            $table->text('pro_image');
            $table->string('pro_unit');
            $table->text('pro_description')->nullable();
            $table->boolean('pro_status');
            $table->foreignId('providers_id')->references('id')->on('providers');
            $table->foreignId('categories_id')->references('id')->on('categories');
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
