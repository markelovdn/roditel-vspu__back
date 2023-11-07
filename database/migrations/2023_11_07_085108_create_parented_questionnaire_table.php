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
        Schema::create('parented_questionnaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parented_id')->constrained('parenteds');
            $table->foreignId('questionnaire_id')->constrained('questionnaires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parented_questionnaire');
    }
};
