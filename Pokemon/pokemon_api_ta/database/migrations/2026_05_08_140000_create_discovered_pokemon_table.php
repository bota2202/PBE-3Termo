<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discovered_pokemon', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pokemon_api_id')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discovered_pokemon');
    }
};
