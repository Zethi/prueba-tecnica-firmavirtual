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
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('pp')->nullable();
            $table->integer('power')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('accuracy')->nullable();
            $table->foreignId('damage_class_id')->references('id')->on('damage_classes');
            $table->foreignId('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
