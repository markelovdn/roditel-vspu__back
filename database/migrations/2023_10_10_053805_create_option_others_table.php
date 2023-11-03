<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('option_others', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->boolean('show')->default(false);
            $table->foreignId('question_id')->constrained('questions');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('option_others');
    }
};
