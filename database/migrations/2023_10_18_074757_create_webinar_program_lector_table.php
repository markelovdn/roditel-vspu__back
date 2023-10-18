<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_program_lector', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webinar_program_id')->constrained('webinar_programs');
            $table->foreignId('webinar_lector_id')->constrained('webinar_lectors');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_program_lector');
    }
};
