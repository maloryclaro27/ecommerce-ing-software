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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('rol')->default('cliente')->after('direccion');
            $table->string('categoria_negocio')->nullable()->after('rol');
            $table->string('nombre_negocio')->nullable()->after('categoria_negocio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('rol');
            $table->dropColumn('categoria_negocio');
            $table->dropColumn('nombre_negocio');
        });
    }
};
