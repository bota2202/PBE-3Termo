<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
    Schema::create('estoque', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->unsignedInteger('quantidade')->default(0);
    $table->unsignedInteger('reservado')->default(0);
    $table->decimal('preco', 8, 2)->nullable();
    $table->date('data_entrada')->nullable();
    $table->timestamps();
    });
 }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};
