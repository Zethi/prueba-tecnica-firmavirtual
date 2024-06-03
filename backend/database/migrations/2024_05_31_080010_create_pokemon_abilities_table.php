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
        Schema::create('pokemon_abilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pokemon_id');
            $table->foreign('pokemon_id')->references('game_id')->on('pokemon');
            $table->foreignId('ability_id')->references('id')->on('abilities');
            $table->integer('slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_abilities');
    }
};
