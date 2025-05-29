<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Cambiamos establecimiento_tipo a varchar para que guarde FQCN
            $table->string('establecimiento_tipo')->nullable()->change();
        });
    }

    public function down(): void
    {
        // No revertimos para evitar conflictos
    }
};
