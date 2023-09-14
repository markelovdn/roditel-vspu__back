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
        Schema::create('questionnaire_answer_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_question_id')->constrained('questionnaire_questions', 'id');
            $table->foreignId('questionnaire_answer_id')->nullable()->default(NULL)->constrained('questionnaire_answers', 'id');
            $table->foreignId('parented_answer_id')->nullable()->default(NULL)->constrained('questionnaire_parented_answers', 'id');
            $table->integer('count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_answer_counts');
    }
};
