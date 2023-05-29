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
        Schema::create('school_user', function (Blueprint $table) {
            $table->foreignId('school_id')->reference('id')->on('school');
            $table->foreignId('user_id')->reference('id')->on('users');
        });

        DB::table('school_user')->insert([
            [
                'school_id' => 1,
                'user_id' => 3,
            ],
            [
                'school_id' => 3,
                'matiere_id' => 2,
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('school_user')->delete();
        Schema::dropIfExists('school_user');
    }
};
