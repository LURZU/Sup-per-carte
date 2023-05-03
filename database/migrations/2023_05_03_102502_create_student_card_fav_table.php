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
        Schema::create('student_card_fav', function (Blueprint $table) {
            $table->foreignId('id_student')->reference('id')->on('student');
            $table->foreignId('id_public_card')->reference('id')->on('public_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_card_fav');
    }
};
