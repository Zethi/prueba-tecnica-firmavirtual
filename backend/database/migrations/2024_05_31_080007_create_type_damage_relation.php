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
        Schema::create('type_damage_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_type_id')->references('id')->on('types');
            $table->foreignId('damage_relation_type_id')->references('id')->on('damage_relation_types');
            $table->foreignId('to_type_id')->references('id')->on('types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_damage_relations');
    }
};
