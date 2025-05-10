<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Añade los campos justo después de producto_id
            $table->unsignedBigInteger('establecimiento_id')
                  ->after('producto_id')
                  ->comment('ID del restaurante/tienda/droguería');

            $table->unsignedTinyInteger('establecimiento_tipo')
                  ->after('establecimiento_id')
                  ->comment('0=Restaurante,1=Droguería,2=TiendaRopa,3=Tecnología');

            // Si aún no tienes el índice único, agréga-lo aquí:
            $table->unique(['user_id', 'producto_id'], 'cart_user_producto_unique');
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Elimina primero el índice único
            $table->dropUnique('cart_user_producto_unique');

            // Luego elimina las columnas
            $table->dropColumn(['establecimiento_tipo', 'establecimiento_id']);
        });
    }
};
