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
        Schema::create('lector_webinar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lector_id')->constrained('lectors');
            $table->foreignId('webinar_id')->constrained('webinars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lector_webinar');
    }
};
