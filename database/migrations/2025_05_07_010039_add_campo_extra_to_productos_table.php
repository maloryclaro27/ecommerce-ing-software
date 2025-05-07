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
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('drogueria_id')->nullable()->after('restaurante_id');
            $table->foreign('drogueria_id')
                  ->references('id')
                  ->on('droguerias')
                  ->onDelete('set null');

            // Añadir columna ropa_id
            $table->unsignedBigInteger('ropa_id')
                  ->nullable()
                  ->after('drogueria_id');
            $table->foreign('ropa_id')
                  ->references('id')
                  ->on('ropa')
                  ->onDelete('set null');

            // Añadir columna tecnologia_id
            $table->unsignedBigInteger('tecnologia_id')
                  ->nullable()
                  ->after('ropa_id');
            $table->foreign('tecnologia_id')
                  ->references('id')
                  ->on('tecnologia')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['drogueria_id']);
            $table->dropColumn('drogueria_id');
            // Primero eliminamos los índices de clave foránea
            $table->dropForeign(['ropa_id']);
            $table->dropForeign(['tecnologia_id']);

            // Luego eliminamos las columnas
            $table->dropColumn('ropa_id');
            $table->dropColumn('tecnologia_id');
        });

    }
};
