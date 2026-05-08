<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('custom_id')->unique(); // começa em 1026
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('types')->nullable();       // ex: "fire,water"
            $table->integer('height')->default(0);     // em decímetros
            $table->integer('weight')->default(0);     // em hectogramas
            $table->integer('hp')->default(50);
            $table->integer('attack')->default(50);
            $table->integer('defense')->default(50);
            $table->integer('speed')->default(50);
            $table->string('abilities')->nullable();   // ex: "blaze,solar-power"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_pokemon');
    }
};
