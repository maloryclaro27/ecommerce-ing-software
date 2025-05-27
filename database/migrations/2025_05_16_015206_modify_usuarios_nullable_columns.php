<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('telefono')->nullable()->change();
            $table->string('direccion')->nullable()->change();
            $table->integer('loyalty_points')->nullable()->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('telefono')->nullable(false)->change();
            $table->string('direccion')->nullable(false)->change();
            $table->integer('loyalty_points')->nullable(false)->default(null)->change();
        });
    }
};
