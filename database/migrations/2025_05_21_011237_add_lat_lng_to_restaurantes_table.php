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
        Schema::table('restaurantes', function (Blueprint $table) {
            $table->string('direccion')
                  ->after('nombre');
            // Agrega latitud y longitud al final de la tabla restaurantes
            $table->decimal('lat', 10, 7)
                  ->nullable()
                  ->after('direccion');
            $table->decimal('lng', 10, 7)
                  ->nullable()
                  ->after('lat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurantes', function (Blueprint $table) {
            // Elimina las columnas lat y lng
            $table->dropColumn(['direccion','lat', 'lng']);
        });
    }
};
