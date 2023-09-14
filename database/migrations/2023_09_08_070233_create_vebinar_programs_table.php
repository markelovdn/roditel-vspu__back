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
        Schema::create('vebinar_programs', function (Blueprint $table) {
            $table->id();
            $table->time('time_start')->nullable();
            $table->string('subject')->nullable();
            $table->string('lector_description')->nullable();
            $table->string('lector_department')->nullable();
            $table->string('lector_photo')->nullable();
            $table->foreignId('vebinar_id')->constrained('vebinars', 'id')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vebinar_programs');
    }
};
