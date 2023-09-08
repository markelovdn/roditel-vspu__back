<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultant_answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer_text')->require();
            $table->foreignId('parented_question_id')->constrained('parented_questions', 'id')->require();
            $table->foreignId('consultant_id')->constrained('consultants', 'id')->require();
            $table->foreignId('consultation_id')->constrained('consultations', 'id')->require();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultant_answers');
    }
};
