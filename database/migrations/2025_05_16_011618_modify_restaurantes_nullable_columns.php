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
            // Permitir NULL en tipo e imagen
            $table->string('tipo')->nullable()->change();
            $table->string('imagen')->nullable()->change();

            // Permitir NULL y valor por defecto 0 en rating
            $table->unsignedTinyInteger('rating')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurantes', function (Blueprint $table) {
            // Revertir a NOT NULL sin default
            $table->string('tipo')->nullable(false)->change();
            $table->string('imagen')->nullable(false)->change();
            $table->unsignedTinyInteger('rating')->nullable(false)->default(null)->change();
        });
    }
};
