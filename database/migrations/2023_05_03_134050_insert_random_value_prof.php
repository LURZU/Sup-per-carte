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
        DB::table('prof')->insert([
            [
                'user_id' => '4',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'civil_status' => 'M',
                'email' => 'johndoe@studiodefacto.com',
                'matiere_id' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('prof')->delete();
    }
};
