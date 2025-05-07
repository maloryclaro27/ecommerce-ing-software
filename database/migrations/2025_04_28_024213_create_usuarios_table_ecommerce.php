<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->comment('Nombre completo del usuario');
            $table->string('correo_electronico')->unique()->comment('Correo electrónico');
            $table->string('identificacion')->unique()->comment('Cédula');
            $table->timestamp('fecha_verificacion_correo')
                  ->nullable()
                  ->comment('Fecha en que se verificó el correo');
            $table->string('contrasena')->comment('Contraseña cifrada');
            $table->rememberToken('token_recordarme')
                  ->comment('Token para “recordarme” en sesiones');
            $table->timestamp('creado_en')
                  ->useCurrent()
                  ->comment('Fecha de creación del registro');
            $table->timestamp('actualizado_en')
                  ->useCurrent()           // <--- AÑADE useCurrent()
                  ->useCurrentOnUpdate()   // <--- Y mantén useCurrentOnUpdate()
                  ->comment('Fecha de última actualización');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
