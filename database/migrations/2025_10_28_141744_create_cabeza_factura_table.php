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
        Schema::create('cabeza_factura', function (Blueprint $table) {
            $table->id('numero');
            $table->date('fecha');
            $table->foreignId('cliente')->constrained('clientes', 'cliente')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabeza_factura');
    }
};
