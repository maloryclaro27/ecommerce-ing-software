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
            // Agrega la columna 'imagen' (url) después de 'rating'
            $table->string('imagen')
                  ->nullable()
                  ->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurantes', function (Blueprint $table) {
            // Elimina la columna 'imagen'
            $table->dropColumn('imagen');
        });
    }
};
