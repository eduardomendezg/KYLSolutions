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
    Schema::create('ventas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
        $table->foreignId('user_id')->constrained('usuarios');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('impuestos', 10, 2)->default(0.00);
        $table->decimal('total', 10, 2);
        $table->string('metodo_pago'); 
        $table->decimal('pago_con', 10, 2)->default(0.00); 
        $table->decimal('cambio', 10, 2)->default(0.00);
        $table->string('referencia_pago')->nullable();
        $table->string('numero_ticket')->unique(); 
        $table->boolean('factura_enviada')->default(false);
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
