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
        // Hacer nullable la columna 'imagen' en las tablas de categorías sin 'tipo' ni 'rating'
        Schema::table('droguerias', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });

        Schema::table('ropa', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });

        Schema::table('tecnologia', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('droguerias', function (Blueprint $table) {
            $table->string('imagen')->nullable(false)->change();
        });

        Schema::table('ropa', function (Blueprint $table) {
            $table->string('imagen')->nullable(false)->change();
        });

        Schema::table('tecnologia', function (Blueprint $table) {
            $table->string('imagen')->nullable(false)->change();
        });
    }
};
