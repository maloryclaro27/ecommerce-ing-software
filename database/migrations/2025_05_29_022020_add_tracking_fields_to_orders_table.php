<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('establecimiento_id')->nullable()->after('transporte_id');
            $table->string('establecimiento_tipo')->nullable()->after('establecimiento_id');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['establecimiento_id', 'establecimiento_tipo']);
        });
    }
};

