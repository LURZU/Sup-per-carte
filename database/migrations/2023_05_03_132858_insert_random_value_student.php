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
        DB::table('students')->insert([
            [
                'email' => 'tom@studiodefacto.com',
                'user_id' => 3,
                'first_name' => 'Tom',
                'last_name' => 'DEFACTO',
                'class_id' => 1,
                'filliere' => 'Sup MATH'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('students')->delete();
    }
};
