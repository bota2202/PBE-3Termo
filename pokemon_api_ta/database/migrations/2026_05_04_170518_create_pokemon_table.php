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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('pokemon_api_id')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->dropColumn('pokemon_api_id');
        });
    }
};
