<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // cliente que fez o pedido
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();

            // status do pedido
            $table->string('status')->default('aberto'); // aberto | reservado | pendente | finalizado | cancelado

            // data do pedido (opcional)
            $table->date('data_pedido')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

?>