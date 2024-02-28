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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('peo_name',80);
            $table->string('peo_lastname',80);
            $table->string('peo_adress',100);
            $table->integer('peo_phone');
            $table->date('peo_dateBirth');
            $table->text('peo_image');
            $table->boolean('peo_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
