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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('label');
        });

        DB::table('schools')->insert([
            [
                'label' => 'Montpellier',
            ],
            [
                'label' => 'Toulouse',
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('schools')->delete();
        Schema::dropIfExists('schools');
    }
};
