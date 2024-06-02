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
        Schema::create('pokemon_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pokemon_id');
            $table->foreign('pokemon_id')->references('game_id')->on('pokemon');
            $table->foreignId('stat_id')->references('id')->on('stats');
            $table->integer('base')->nullable();
            $table->integer('effort')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_stats');
    }
};
