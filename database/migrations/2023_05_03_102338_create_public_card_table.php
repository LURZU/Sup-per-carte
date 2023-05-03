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
        Schema::create('public_card', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_prof')->nullable()->reference('id')->on('prof');
            $table->foreignId('id_matiere')->reference('id')->on('matiere');
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->foreignId('id_student')->nullable()->reference('id')->on('student');
            $table->boolean('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_card');
    }
};
