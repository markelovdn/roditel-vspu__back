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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 45);
            $table->string('second_name', 45);
            $table->string('patronymic', 45);
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles', 'id');
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
