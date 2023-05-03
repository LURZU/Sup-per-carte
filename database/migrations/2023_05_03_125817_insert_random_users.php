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
        DB::table('users')->insert([
            [
                'email' => 'support@defacto.ovh',
                'password' => '$2y$10$WvFC5wxabNl2D2Ngwkls3OJpiU97SkLawn28aFzGwaVK96OqnDzr2',
                'name' => 'DEFACTO DEFACTO',
            ],
            [
                'email' => 'tom@studiodefacto.com',
                'password' => '$2y$10$WvFC5wxabNl2D2Ngwkls3OJpiU97SkLawn28aFzGwaVK96OqnDzr2',
                'name' => 'Tom',
            ],
            [
                'email' => 'johnDoe@studiodefacto.com',
                'password' => '$2y$10$WvFC5wxabNl2D2Ngwkls3OJpiU97SkLawn28aFzGwaVK96OqnDzr2',
                'name' => 'M.John Doe',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->delete();
    }
};
