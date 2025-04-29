<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuariosEcommerce extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');                                      // Identificador único
            $table->string('nombre')->comment('Nombre completo del usuario');  // Nombre
            $table->string('correo_electronico')->unique()->comment('Correo electrónico');
            $table->string('identificacion')->unique()->comment('cedula');  
            $table->timestamp('fecha_verificacion_correo')
                  ->nullable()
                  ->comment('Fecha en que se verificó el correo');
            $table->string('contrasena')->comment('Contraseña cifrada');      // Contraseña
            $table->rememberToken('token_recordarme')
                  ->comment('Token para “recordarme” en sesiones');
            $table->timestamp('creado_en')
                  ->useCurrent()
                  ->comment('Fecha de creación del registro');
            $table->timestamp('actualizado_en')
                  ->useCurrentOnUpdate()
                  ->comment('Fecha de última actualización');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
