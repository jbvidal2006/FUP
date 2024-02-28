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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('use_name');
            $table->string('use_phone')->unique();
            $table->timestamp('use_phone_verified_at')->nullable();
            $table->string('use_password');
            $table->string('use_rol');
            $table->boolean('use_status');
            $table->foreignId('people_id')->references('id')->on('people');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
