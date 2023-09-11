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
        Schema::create('parented_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text')->require();
            $table->foreignId('parented_id')->constrained('parenteds', 'id')->require();
            $table->foreignId('specialization_id')->constrained('specializations', 'id')->require();
            $table->foreignId('consultant_id')->constrained('consultants', 'id')->nullable()->default(0);
            $table->foreignId('consultation_id')->constrained('consultations', 'id')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parented_questions');
    }
};
