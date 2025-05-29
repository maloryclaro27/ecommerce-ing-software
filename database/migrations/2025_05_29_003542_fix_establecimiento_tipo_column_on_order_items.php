<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Cambiamos establecimiento_tipo a varchar(255)
            $table->string('establecimiento_tipo')->nullable()->change();
        });
    }

    public function down(): void
    {
        // No revertimos nada para evitar el problema de convertir strings a int
    }
};
