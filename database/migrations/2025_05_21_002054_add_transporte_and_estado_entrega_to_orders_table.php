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
        Schema::table('orders', function (Blueprint $table) {
            // Agrega referencia al transporte seleccionado (nullable hasta que elijan)
            $table->unsignedBigInteger('transporte_id')
                  ->nullable()
                  ->after('estado');

            // Agrega estado de entrega: preparación → en_curso → entregado
            $table->enum('estado_entrega', ['preparación', 'en_curso', 'entregado'])
                  ->default('preparación')
                  ->after('transporte_id');

            // Llave foránea a transportes.id
            $table->foreign('transporte_id')
                  ->references('id')
                  ->on('transportes')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Elimina primero la llave foránea
            $table->dropForeign(['transporte_id']);

            // Luego elimina las columnas añadidas
            $table->dropColumn('transporte_id');
            $table->dropColumn('estado_entrega');
        });
    }
};
