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
        Schema::create('request_apps', function (Blueprint $table) {
            $table->id();
            $table->date('req_dateRequest');
            $table->string('rep_type',80);
            $table->text('req_description')->nullable();
            $table->boolean('req_status');
            $table->foreignId('people_id')->references('id')->on('people');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
