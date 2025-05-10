<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Elimina el default de la columna 'status'
        DB::statement("ALTER TABLE orders MODIFY status VARCHAR(255) NULL");

        // Renombra la columna
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('status', 'estado');
        });

        // Restaura el default si lo necesitas
        DB::statement("ALTER TABLE orders MODIFY estado VARCHAR(255) DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY estado VARCHAR(255) NULL");

        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('estado', 'status');
        });

        DB::statement("ALTER TABLE orders MODIFY status VARCHAR(255) DEFAULT 'pending'");
    }
};
