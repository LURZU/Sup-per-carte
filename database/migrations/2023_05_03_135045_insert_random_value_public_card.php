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
        DB::table('public_card')->insert([
            [
                'id_prof' => 1,
                'id_matiere' => 1,
                'question' => 'Quelle est la capitale de la France ?',
                'answer' => 'Paris',
                'id_student' => 1,
                'is_public' => true,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('public_card')->delete();
    }
};
