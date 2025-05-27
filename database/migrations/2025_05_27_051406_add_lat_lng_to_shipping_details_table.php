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
        Schema::table('shipping_details', function (Blueprint $table) {
            // Agrega latitud y longitud al detalle de envío
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
        Schema::table('shipping_details', function (Blueprint $table) {
            // Elimina las columnas lat y lng
            $table->dropColumn(['lat', 'lng']);
        });
    }
};
