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
        Schema::table('restaurantes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('nombre');
        });

        Schema::table('droguerias', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('nombre');
        });

        Schema::table('ropa', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('nombre');
        });

        Schema::table('tecnologia', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('nombre');
        });
    }

    public function down(): void
    {
        Schema::table('restaurantes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('droguerias', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('tienda_ropa', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('tecnologia', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
