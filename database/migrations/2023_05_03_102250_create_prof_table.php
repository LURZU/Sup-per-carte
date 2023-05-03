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
        Schema::create('prof', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('civil_status');
            $table->foreignId('matiere_id')->reference('id')->on('matiere');
            $table->foreignId('user_id')->reference('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prof');
    }
};
