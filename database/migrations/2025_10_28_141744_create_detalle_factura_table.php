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
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero');
            $table->unsignedBigInteger('producto');
            $table->integer('cantidad');
            $table->decimal('valor', 15, 2);
            $table->timestamps();

            $table->foreign('numero')->references('numero')->on('cabeza_factura')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('producto')->references('producto')->on('productos')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_factura');
    }
};
