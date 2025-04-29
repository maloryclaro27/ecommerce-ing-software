<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
        
            // user_id sigue igual (asume users.id es bigIncrements)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
        
            // product_id como INT unsigned para que coincida con productos.id
            $table->unsignedInteger('product_id');
        
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
        
            // llave foránea apuntando a productos.id
            $table->foreign('product_id')
                  ->references('id')
                  ->on('productos')      // nombre real de tu tabla
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}

