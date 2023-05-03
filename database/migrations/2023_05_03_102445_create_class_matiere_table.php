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
        Schema::create('class_matiere', function (Blueprint $table) {
            $table->foreignId('id_class')->reference('id')->on('class');
            $table->foreignId('id_matiere')->reference('id')->on('matiere');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_matiere');
    }
};
