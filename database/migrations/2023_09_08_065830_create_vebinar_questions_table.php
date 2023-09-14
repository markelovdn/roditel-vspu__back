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
        Schema::create('vebinar_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_text')->nullable();
            $table->foreignId('vebinar_id')->constrained('vebinars', 'id')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vebinar_questions');
    }
};
