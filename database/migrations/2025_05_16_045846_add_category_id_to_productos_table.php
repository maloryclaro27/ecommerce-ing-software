<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // 1) Añadimos la columna como nullable para no romper la FK con los datos actuales
            $table->unsignedBigInteger('category_id')
                  ->nullable()
                  ->after('user_id');

            // 2) Creamos la foreign key apuntando a catalogo.id
            $table->foreign('category_id')
                  ->references('id')
                  ->on('catalogo')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Primero soltamos la FK
            $table->dropForeign(['category_id']);

            // Luego borramos la columna
            $table->dropColumn('category_id');
        });
    }
}
