<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();

            // produto do estoque (sua tabela é "estoqu")
            $table->foreignId('estoque_id')->constrained('estoque')->cascadeOnDelete();

            $table->unsignedInteger('quantidade');
            $table->unsignedInteger('quantidade_reservada')->default(0);
            $table->unsignedInteger('quantidade_em_falta')->default(0);

            $table->decimal('preco_unitario', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
    }
};

?>