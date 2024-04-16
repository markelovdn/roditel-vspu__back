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
        Schema::create('consultant_reports', function (Blueprint $table) {
            $table->id();
            $table->string('file_url')->require();
            $table->string('upload_status')->nullable();
            $table->foreignId('consultant_id')->constrained('consultants', 'id')->onDelete('cascade')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_reports');
    }
};
