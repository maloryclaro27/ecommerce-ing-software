<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['drone','moto','bicicleta']);
            $table->enum('estado', ['activo','ocupado','inactivo']);
            $table->string('nombre_domiciliario')->nullable();
            // Opcional: lat/lng actual si quieres tracking en tiempo real
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transportes');
    }
};
