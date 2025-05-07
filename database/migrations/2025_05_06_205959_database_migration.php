<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       
        Schema::create('catalogo', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->text('descripcion');
            $table->string('imagen', 1000);
            $table->timestamps();
        });

        Schema::create('droguerias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

     

    


      

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('restaurante_id')->nullable();
            $table->string('nombre', 90);
            $table->text('descripcion');
            $table->decimal('precio', 65, 0);
            $table->string('imagen', 1000);
            $table->timestamps();
        });

        Schema::create('productos_droguerias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('productos_ropa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('productos_tecnologia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('tipo', 40);
            $table->float('rating');
            $table->string('imagen')->nullable();
            $table->timestamps();
        });

        Schema::create('ropa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

     

        Schema::create('tecnologia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('imagen', 1000)->nullable();
            $table->timestamps();
        });

      
    }

    public function down(): void
    {
      
        Schema::dropIfExists('tecnologia');
      
        Schema::dropIfExists('ropa');
        Schema::dropIfExists('restaurantes');
        Schema::dropIfExists('productos_tecnologia');
        Schema::dropIfExists('productos_ropa');
        Schema::dropIfExists('productos_droguerias');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('migrations');

        Schema::dropIfExists('droguerias');
        Schema::dropIfExists('catalogo');
     
    }
};

