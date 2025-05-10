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
        Schema::create('order_items', function(Blueprint $table){
            $table->id();
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 12, 2);
            // opcional: si quieres registrar establecimiento
            $table->unsignedBigInteger('establecimiento_id');
            $table->unsignedTinyInteger('establecimiento_tipo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
