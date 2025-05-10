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
            $table->unsignedInteger('loyalty_points')
                  ->default(0)
                  ->comment('Puntos acumulados de fidelización');
        });
    }
    public function down(): void
    {
        Schema::table('usuarios', function(Blueprint $table){
            $table->dropColumn('loyalty_points');
        });
    }
};
